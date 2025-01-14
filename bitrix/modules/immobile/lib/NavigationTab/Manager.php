<?php

namespace Bitrix\ImMobile\NavigationTab;

use DateTimeInterface;
use CCloudStorageBucket;
use CSmile;
use CUser;
use Bitrix\Mobile;
use Bitrix\MobileApp;
use Bitrix\Im\V2\Chat\GeneralChat;
use Bitrix\ImMobile\Settings;
use Bitrix\Im\Integration\Imopenlines\Localize;
use Bitrix\Im\Integration\Imopenlines\User;
use Bitrix\Intranet\Invitation;
use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;
use Bitrix\Main\Config\Option;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ORM\Query\Filter\Helper;

class Manager
{
	use MessengerComponentTitle;

	private Mobile\Context $context;

	private Tab\Copilot $copilot;
	private Tab\Messenger $messenger;
	private Tab\Notifications $notifications;
	private Tab\OpenLines $openLines;
	private Tab\Channel $channel;

	public function __construct(Mobile\Context $context)
	{
		$this->context = $context;
		
		$this->messenger = new Tab\Messenger();
		$this->copilot = new Tab\Copilot();
		$this->openLines = new Tab\OpenLines($context);
		$this->notifications = new Tab\Notifications($context);
		$this->channel = new Tab\Channel();
	}
	
	public function isNextNavigation(): bool
	{
		return MobileApp\Mobile::getApiVersion() >= 41;
	}
	
	public function getMessengerComponent(): array
	{
		$items = array_values(
			array_filter($this->getSortedItems(), static fn ($item) => $item->isAvailable())
		);

		$itemsData = [];
		$sharedParams = $this->getSharedParams();
		foreach ($items as $item)
		{
			if ($item->isNeedMergeSharedParams())
			{
				$item->mergeParams($sharedParams);
			}

			$itemsData[] = $item->getComponentData();
		}

		return [
			'sort' => 100,
			'imageName' => 'chat',
			'badgeCode' => 'messages',
			'component' => [
				'name' => 'JSStackComponent',
				'title' => Loc::getMessage('MD_COMPONENT_IM_RECENT'),
				'componentCode' => 'im.navigation',
				'scriptPath' => MobileApp\Janative\Manager::getComponentPath('im:im.navigation'),
				'params' => [
					'firstTabId' => $items[0]->getId(),
				],
				'rootWidget' => [
					'name' => 'tabs',
					'settings' => [
						'code' => 'im.tabs',
						'objectName' => 'tabs',
						'titleParams'=> [
							'text' => $this->getTitle(),
							'useLargeTitleMode' => true
						],
						'tabs' => [
							'items' => $itemsData,
						],
					],
				],
			],
		];
	}

	public function getOldChatComponent(): array
	{
		return [
			'sort' => 100,
			'imageName' => 'chat',
			'badgeCode' => 'messages',
			'component' => [
				'name' => 'JSComponentChatRecent',
				'componentCode' => 'im.recent',
				'scriptPath' => MobileApp\Janative\Manager::getComponentPath('im:im.recent'),
				'params' => array_merge(
					$this->getSharedParams(),
					[
						'TAB_CODE' => 'chats',
						'COMPONENT_CODE' => 'im.recent',
						'MESSAGES' => [
							'COMPONENT_TITLE' => $this->getTitle(),
						],
					],
				),
				'settings' => [
					'useSearch' => true,
					'preload' => true,
					'titleParams' => [
						'useLargeTitleMode' => true,
						'text' => $this->getTitle()
					],
				],
			],
		];
	}

	/**
	 * @return Tab\TabInterface[]
	 */
	private function getSortedItems(): array
	{
		if ($this->isLinesOperator())
		{
			if ((new Mobile\Tab\Manager())->getPresetName() === 'crm')
			{
				return $this->getCrmOpenLineOperatorPreset();
			}

			return $this->getOpenLineOperatorPreset();
		}

		return $this->getDefaultPreset();
	}

	private function getCrmOpenLineOperatorPreset(): array
	{
		return [
			$this->openLines,
			$this->messenger,
			$this->channel,
			$this->copilot,
			$this->notifications,
		];
	}

	private function getOpenLineOperatorPreset(): array
	{
		return [
			$this->messenger,
			$this->channel,
			$this->copilot,
			$this->openLines,
			$this->notifications,
		];
	}

	private function getDefaultPreset(): array
	{
		return [
			$this->messenger,
			$this->channel,
			$this->copilot,
			$this->notifications,
			$this->openLines,
		];
	}

	private function getSharedParams(): array
	{
		$isCloud = ModuleManager::isModuleInstalled('bitrix24') && defined('BX24_HOST_NAME');

		$hasActiveBucket = false;
		if (Loader::includeModule('clouds'))
		{
			$buckets = CCloudStorageBucket::getAllBuckets();
			foreach ($buckets as $bucket)
			{
				if ($bucket['ACTIVE'] === 'Y' && $bucket['READ_ONLY'] !== 'Y')
				{
					$hasActiveBucket = true;
					break;
				}
			}
		}

		return array_merge(
			[
				'USER_ID' => $this->context->userId,
				'SITE_ID' => $this->context->siteId,
				'SITE_DIR' => $this->context->siteDir,
				'LANGUAGE_ID' => LANGUAGE_ID,
				'LIMIT_ONLINE' => CUser::GetSecondsForLimitOnline(),
				'IM_GENERAL_CHAT_ID' => GeneralChat::getGeneralChatId(),
				'SEARCH_MIN_SIZE' => Helper::getMinTokenSize()?: 3,
				'OPENLINES_USER_IS_OPERATOR' => $this->openLines->isAvailable(),

				'WIDGET_CHAT_CREATE_VERSION' => MobileApp\Janative\Manager::getComponentVersion('im:im.chat.create'),
				'WIDGET_CHAT_USERS_VERSION' => MobileApp\Janative\Manager::getComponentVersion('im:im.chat.user.list'),
				'WIDGET_CHAT_RECIPIENTS_VERSION' => MobileApp\Janative\Manager::getComponentVersion('im:im.chat.user.selector'),
				'WIDGET_CHAT_TRANSFER_VERSION' => MobileApp\Janative\Manager::getComponentVersion('im:im.chat.transfer.selector'),
				'WIDGET_BACKDROP_MENU_VERSION' => MobileApp\Janative\Manager::getComponentVersion('backdrop.menu'),
				'COMPONENT_CHAT_DIALOG_VERSION' => Mobile\WebComponentManager::getWebComponentVersion('im.dialog'),
				'COMPONENT_CHAT_DIALOG_VUE_VERSION' => Mobile\WebComponentManager::getWebComponentVersion('im.dialog.vue'),

				'MIN_SEARCH_SIZE' => Helper::getMinTokenSize(),
				'IS_NETWORK_SEARCH_AVAILABLE' => $this->isNetworkSearchAvailable(),
				'IS_DEVELOPMENT_ENVIRONMENT' => $this->isDevelopmentEnvironment(),

				'MESSAGES' => [
					'IMOL_CHAT_ANSWER_M' => Localize::get(Localize::FILE_LIB_CHAT, "IMOL_CHAT_ANSWER_M"),
					'IMOL_CHAT_ANSWER_F' => Localize::get(Localize::FILE_LIB_CHAT, "IMOL_CHAT_ANSWER_F"),
				],

				'NEXT_NOTIFICATIONS' => $this->isNextNotifications() ? 'Y': 'N',
				'NEXT_NAVIGATION' => $this->isNextNavigation() ? 'Y': 'N',

				'IS_CLOUD' => $isCloud,
				'HAS_ACTIVE_CLOUD_STORAGE_BUCKET' => $hasActiveBucket,
				'IS_BETA_AVAILABLE' => Settings::isBetaAvailable(),
				'IS_CHAT_M1_ENABLED' => Settings::isChatM1Enabled(),
				'IS_CHAT_LOCAL_STORAGE_AVAILABLE' => Settings::isChatLocalStorageAvailable(),
				'SHOULD_SHOW_CHAT_V2_UPDATE_HINT' => Settings::shouldShowChatV2UpdateHint(),
				'SMILE_LAST_UPDATE_DATE' => CSmile::getLastUpdate()->format(DateTimeInterface::ATOM),
				'IS_COPILOT_AVAILABLE' => Settings::isCopilotAvailable(),
				'IS_COPILOT_ADD_USERS' => Settings::isCopilotAddUsersEnabled(),
				'CAN_USE_TELEPHONY' => Loader::includeModule('voximplant') && \Bitrix\Voximplant\Security\Helper::canCurrentUserPerformCalls(),
			],
			$this->getInvitationParams(),
		);
	}

	/**
	 * @deprecated
	 */
	private function getInvitationParams(): array
	{
		$isIntranetInvitationAdmin = (
			Loader::includeModule('intranet')
			&& Invitation::canListDelete()
		);
		
		$canInvite = (
			Loader::includeModule('intranet')
			&& Invitation::canCurrentUserInvite()
		);

		$registerUrl = (
		$canInvite
			? Invitation::getRegisterUrl()
			: ''
		);

		$registerAdminConfirm = (
		$canInvite
			? Invitation::getRegisterAdminConfirm()
			: 'N'
		);

		$disableRegisterAdminConfirm = !Invitation::canListDelete();

		$registerSharingMessage = (
		$canInvite
			? Invitation::getRegisterSharingMessage()
			: ''
		);

		$rootStructureSectionId = Invitation::getRootStructureSectionId();

		return [
			'INTRANET_INVITATION_CAN_INVITE' => $canInvite,
			'INTRANET_INVITATION_ROOT_STRUCTURE_SECTION_ID' => $rootStructureSectionId,
			'INTRANET_INVITATION_REGISTER_URL' => $registerUrl,
			'INTRANET_INVITATION_REGISTER_ADMIN_CONFIRM' => $registerAdminConfirm,
			'INTRANET_INVITATION_REGISTER_ADMIN_CONFIRM_DISABLE' => $disableRegisterAdminConfirm,
			'INTRANET_INVITATION_REGISTER_SHARING_MESSAGE' => $registerSharingMessage,
			'INTRANET_INVITATION_IS_ADMIN' => $isIntranetInvitationAdmin,
		];
	}

	private function isDevelopmentEnvironment(): bool
	{
		return Option::get('immobile', 'IS_DEVELOPMENT_ENVIRONMENT', 'N') === 'Y';
	}

	private function isNextNotifications(): bool
	{
		return Option::get('mobile', 'NEXT_NOTIFICATIONS', 'N') !== 'N';
	}

	private function isNetworkSearchAvailable(): bool
	{
		return Loader::includeModule('imbot') && class_exists('\Bitrix\ImBot\Integration\Ui\EntitySelector\NetworkProvider');
	}

	private function isLinesOperator(): bool
	{
		if (!ModuleManager::isModuleInstalled('imopenlines'))
		{
			return false;
		}

		return User::isOperator();
	}
}