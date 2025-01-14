<?php

namespace Bitrix\Im\V2\Chat;

use Bitrix\Im\V2\Chat;
use Bitrix\Main\Engine\Response\Converter;
use Bitrix\Main\Loader;

class Permission
{
	public const ACTION_CALL = 'CALL';
	public const ACTION_MUTE = 'MUTE';
	public const ACTION_LEAVE = 'LEAVE';
	public const ACTION_LEAVE_OWNER = 'LEAVE_OWNER';
	public const ACTION_SEND = 'SEND';
	public const ACTION_USER_LIST = 'USER_LIST';

	public const ACTION_CHANGE_AVATAR = 'AVATAR';
	public const ACTION_RENAME = 'RENAME';
	public const ACTION_EXTEND = 'EXTEND';
	public const ACTION_KICK = 'KICK';
	public const ACTION_CHANGE_COLOR = 'COLOR';
	public const ACTION_CHANGE_DESCRIPTION = 'DESCRIPTION';
	public const ACTION_CHANGE_RIGHTS = 'RIGHT';
	public const ACTION_OPEN_EDIT = 'EDIT';
	public const ACTION_CHANGE_OWNER = 'CHANGE_OWNER';
	public const ACTION_CHANGE_MANAGERS = 'CHANGE_MANAGERS';
	public const ACTION_PIN_MESSAGE = 'PIN_MESSAGE';
	public const ACTION_CREATE_TASK = 'CREATE_TASK';
	public const ACTION_CREATE_MEETING = 'CREATE_MEETING';
	public const ACTION_DELETE_OTHERS_MESSAGE = 'DELETE_OTHERS_MESSAGE';

	public const TYPE_DEFAULT = 'DEFAULT';
	public const TYPE_GENERAL = 'GENERAL';
	public const TYPE_CHANNEL = 'CHANNEL';
	public const TYPE_OPEN_CHANNEL = 'OPEN_CHANNEL';
	public const TYPE_COMMENT = 'COMMENT';
	public const TYPE_SONET = EntityLink::TYPE_SONET;
	public const TYPE_TASKS = EntityLink::TYPE_TASKS;
	public const TYPE_CRM = EntityLink::TYPE_CRM;
	public const TYPE_CALL = EntityLink::TYPE_CALL;
	public const TYPE_ANNOUNCEMENT = 'ANNOUNCEMENT';
	public const TYPE_COPILOT = 'COPILOT';

	public const GROUP_MANAGE_UI = 'MANAGE_UI';
	public const GROUP_MANAGE_USERS_ADD = 'MANAGE_USERS_ADD';
	public const GROUP_MANAGE_USERS_DELETE = 'MANAGE_USERS_DELETE';
	public const GROUP_MANAGE_SETTINGS = 'MANAGE_SETTINGS';
	public const MANAGE_MESSAGES = 'MANAGE_MESSAGES';

	public const ACTIONS_MANAGE_UI = [
		self::ACTION_RENAME,
		self::ACTION_CHANGE_DESCRIPTION,
		self::ACTION_CHANGE_COLOR,
		self::ACTION_CHANGE_AVATAR,
	];
	public const ACTIONS_MANAGE_USERS_ADD = [self::ACTION_EXTEND];
	public const ACTIONS_MANAGE_USERS_DELETE = [self::ACTION_KICK];
	public const ACTIONS_MANAGE_SETTINGS = [
		self::ACTION_CHANGE_RIGHTS,
		self::ACTION_OPEN_EDIT,
		self::ACTION_CHANGE_OWNER,
		self::ACTION_CHANGE_MANAGERS,
	];
	public const ACTIONS_MANAGE_MESSAGES = [self::ACTION_SEND, self::ACTION_PIN_MESSAGE];

	public const GROUP_ACTIONS = [
		self::GROUP_MANAGE_UI => self::ACTIONS_MANAGE_UI,
		self::GROUP_MANAGE_USERS_ADD => self::ACTIONS_MANAGE_USERS_ADD,
		self::GROUP_MANAGE_USERS_DELETE => self::ACTIONS_MANAGE_USERS_DELETE,
		self::GROUP_MANAGE_SETTINGS => self::ACTIONS_MANAGE_SETTINGS,
		self::MANAGE_MESSAGES => self::ACTIONS_MANAGE_MESSAGES,
	];

	public const GROUP_ACTIONS_DEFAULT_PERMISSIONS = [
		self::GROUP_MANAGE_UI => Chat::ROLE_MEMBER,
		self::GROUP_MANAGE_USERS_ADD => Chat::ROLE_MEMBER,
		self::GROUP_MANAGE_USERS_DELETE => Chat::ROLE_MANAGER,
		self::GROUP_MANAGE_SETTINGS => Chat::ROLE_OWNER,
		self::MANAGE_MESSAGES => Chat::ROLE_MEMBER,
	];

	private static array $permissionsByChatTypes;

	private bool $jsonFormat;
	private Converter $converter;

	public function __construct(bool $jsonFormat = true)
	{
		$this->jsonFormat = $jsonFormat;
		$this->converter = new Converter(Converter::KEYS | Converter::VALUES | Converter::RECURSIVE | Converter::TO_CAMEL | Converter::LC_FIRST);
	}

	public function getByChatTypes(): array
	{
		if (isset(self::$permissionsByChatTypes))
		{
			if ($this->jsonFormat)
			{
				return $this->converter->process(self::$permissionsByChatTypes);
			}

			return self::$permissionsByChatTypes;
		}

		$generalChat = GeneralChat::get();
		$roleForPostToGeneral = Chat::ROLE_MEMBER;
		if ($generalChat !== null)
		{
			$roleForPostToGeneral = $generalChat->getManageMessages();
		}

		$default = [
			self::ACTION_CHANGE_AVATAR => Chat::ROLE_MEMBER,
			self::ACTION_RENAME => Chat::ROLE_MEMBER,
			self::ACTION_EXTEND => Chat::ROLE_MEMBER,
			self::ACTION_CALL => Chat::ROLE_MEMBER,
			self::ACTION_MUTE => Chat::ROLE_MEMBER,
			self::ACTION_LEAVE => Chat::ROLE_MEMBER,
			self::ACTION_LEAVE_OWNER => Chat::ROLE_MEMBER,
			self::ACTION_SEND => Chat::ROLE_MEMBER,
			self::ACTION_USER_LIST => Chat::ROLE_MEMBER,
			self::ACTION_CREATE_TASK => Chat::ROLE_MEMBER,
			self::ACTION_CREATE_MEETING => Chat::ROLE_MEMBER,
			self::ACTION_DELETE_OTHERS_MESSAGE => Chat::ROLE_NONE,
		];

		self::$permissionsByChatTypes[self::TYPE_DEFAULT] = $default;

		self::$permissionsByChatTypes[self::TYPE_GENERAL] = [
			self::ACTION_CHANGE_AVATAR => Chat::ROLE_NONE,
			self::ACTION_RENAME => Chat::ROLE_NONE,
			self::ACTION_EXTEND => Chat::ROLE_NONE,
			self::ACTION_LEAVE => Chat::ROLE_NONE,
			self::ACTION_LEAVE_OWNER => Chat::ROLE_NONE,
			self::ACTION_SEND => $roleForPostToGeneral,
			self::ACTION_DELETE_OTHERS_MESSAGE => Chat::ROLE_MANAGER,
		];

		self::$permissionsByChatTypes[self::TYPE_COPILOT] = [
			self::ACTION_CALL => Chat::ROLE_NONE,
		];

		self::$permissionsByChatTypes[self::TYPE_ANNOUNCEMENT] = [
			self::ACTION_LEAVE_OWNER => Chat::ROLE_OWNER,
			self::ACTION_SEND => Chat::ROLE_MANAGER,
		];

		self::$permissionsByChatTypes[self::TYPE_CHANNEL] = [
			self::ACTION_CALL => Chat::ROLE_NONE,
			self::ACTION_CREATE_TASK => Chat::ROLE_NONE,
			self::ACTION_CREATE_MEETING => Chat::ROLE_NONE,
			self::ACTION_DELETE_OTHERS_MESSAGE => Chat::ROLE_MANAGER,
		];

		self::$permissionsByChatTypes[self::TYPE_OPEN_CHANNEL] = [
			self::ACTION_CALL => Chat::ROLE_NONE,
			self::ACTION_CREATE_TASK => Chat::ROLE_NONE,
			self::ACTION_CREATE_MEETING => Chat::ROLE_NONE,
			self::ACTION_DELETE_OTHERS_MESSAGE => Chat::ROLE_MANAGER,
		];

		self::$permissionsByChatTypes[self::TYPE_COMMENT] = [
			self::ACTION_CALL => Chat::ROLE_NONE,
			self::ACTION_EXTEND => Chat::ROLE_NONE,
			self::ACTION_DELETE_OTHERS_MESSAGE => Chat::ROLE_MANAGER,
		];

		if (Loader::includeModule('imbot'))
		{
			self::$permissionsByChatTypes[\Bitrix\ImBot\Service\Notifier::CHAT_ENTITY_TYPE] = [
				self::ACTION_CHANGE_AVATAR => Chat::ROLE_NONE,
				self::ACTION_RENAME => Chat::ROLE_NONE,
				self::ACTION_LEAVE_OWNER => Chat::ROLE_NONE,
			];

			self::$permissionsByChatTypes[\Bitrix\ImBot\Bot\Support24::CHAT_ENTITY_TYPE] = [
				self::ACTION_CHANGE_AVATAR => Chat::ROLE_NONE,
				self::ACTION_EXTEND => Chat::ROLE_NONE,
				self::ACTION_CALL => Chat::ROLE_NONE,
				self::ACTION_MUTE => Chat::ROLE_NONE,
				self::ACTION_LEAVE => Chat::ROLE_NONE,
				self::ACTION_LEAVE_OWNER => Chat::ROLE_NONE,
				self::ACTION_USER_LIST => Chat::ROLE_NONE,
			];

			self::$permissionsByChatTypes[\Bitrix\ImBot\Bot\Network::CHAT_ENTITY_TYPE] =
				self::$permissionsByChatTypes[\Bitrix\ImBot\Bot\Support24::CHAT_ENTITY_TYPE]
			;
		}

		if (Loader::includeModule('socialnetwork'))
		{
			self::$permissionsByChatTypes[self::TYPE_SONET] = [
				self::ACTION_CHANGE_AVATAR => Chat::ROLE_NONE,
				self::ACTION_RENAME => Chat::ROLE_NONE,
				self::ACTION_EXTEND => Chat::ROLE_NONE,
				self::ACTION_LEAVE => Chat::ROLE_NONE,
				self::ACTION_LEAVE_OWNER => Chat::ROLE_NONE,
			];
		}

		if (Loader::includeModule('tasks'))
		{
			self::$permissionsByChatTypes[self::TYPE_TASKS] = $default;
		}

		if (Loader::includeModule('calendar'))
		{
			self::$permissionsByChatTypes[\CCalendar::CALENDAR_CHAT_ENTITY_TYPE] = $default;
		}

		if (\Bitrix\Main\Loader::includeModule('crm'))
		{
			self::$permissionsByChatTypes[self::TYPE_CRM] = [
				self::ACTION_CHANGE_AVATAR => Chat::ROLE_NONE,
				self::ACTION_RENAME => Chat::ROLE_NONE,
				self::ACTION_LEAVE_OWNER => Chat::ROLE_NONE,
			];
		}

		if (\Bitrix\Main\Loader::includeModule('voximplant'))
		{
			self::$permissionsByChatTypes[self::TYPE_CALL] = [
				self::ACTION_EXTEND => Chat::ROLE_NONE,
				self::ACTION_CALL => Chat::ROLE_NONE,
				self::ACTION_MUTE => Chat::ROLE_NONE,
				self::ACTION_LEAVE => Chat::ROLE_NONE,
				self::ACTION_LEAVE_OWNER => Chat::ROLE_NONE,
			];
		}

		foreach (self::$permissionsByChatTypes as $code => $value)
		{
			self::$permissionsByChatTypes[$code] = array_merge($default, $value);
		}

		if ($this->jsonFormat)
		{
			return $this->converter->process(self::$permissionsByChatTypes);
		}

		return self::$permissionsByChatTypes;
	}

	public static function getRoleForActionByType(string $type, string $action): string
	{
		$permissionService = new static(false);
		$permissions = $permissionService->getByChatTypes();
		$permissionsByType = $permissions[$type] ?? $permissions[self::TYPE_DEFAULT];

		return $permissionsByType[$action] ?? Chat::ROLE_GUEST;
	}

	public function getActionGroupDefinitions(): array
	{
		if ($this->jsonFormat)
		{
			return $this->converter->process(self::GROUP_ACTIONS);
		}

		return self::GROUP_ACTIONS;
	}

	public function getDefaultPermissionForGroupActions(): array
	{
		$channelDefaultPermissions = self::GROUP_ACTIONS_DEFAULT_PERMISSIONS;
		$channelDefaultPermissions[self::MANAGE_MESSAGES] = Chat::ROLE_MANAGER;
		$channelDefaultPermissions[self::GROUP_MANAGE_UI] = Chat::ROLE_MANAGER;

		$defaultPermissionsByTypes = [
			self::TYPE_DEFAULT => self::GROUP_ACTIONS_DEFAULT_PERMISSIONS,
			self::TYPE_CHANNEL => $channelDefaultPermissions,
			self::TYPE_OPEN_CHANNEL => $channelDefaultPermissions,
		];

		if ($this->jsonFormat)
		{
			return $this->converter->process($defaultPermissionsByTypes);
		}

		return $defaultPermissionsByTypes;
	}

	public static function compareRole(string $userRole, string $needRole): bool
	{
		if ($needRole === Chat::ROLE_NONE)
		{
			return false;
		}

		$ascendingRoles = [Chat::ROLE_GUEST, Chat::ROLE_MEMBER, Chat::ROLE_MANAGER, Chat::ROLE_OWNER];
		$userRolePos = array_search($userRole, $ascendingRoles, true);
		$needRolePos = array_search($needRole, $ascendingRoles, true);

		if ($userRole === false || $needRolePos === false)
		{
			return false;
		}

		return $userRolePos >= $needRolePos;
	}
}