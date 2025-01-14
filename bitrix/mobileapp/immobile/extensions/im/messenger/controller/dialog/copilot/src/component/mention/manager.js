/**
 * @module im/messenger/controller/dialog/copilot/component/mention/manager
 */
jn.define('im/messenger/controller/dialog/copilot/component/mention/manager', (require, exports, module) => {
	const { MentionManager } = require('im/messenger/controller/dialog/lib/mention');
	const { CopilotMentionProvider } = require('im/messenger/controller/dialog/copilot/component/mention/provider');
	const { EventType } = require('im/messenger/const');
	const { LoggerManager } = require('im/messenger/lib/logger');
	const logger = LoggerManager.getInstance().getLogger('mention');

	/**
	 * @class CopilotMentionManager
	 */
	class CopilotMentionManager extends MentionManager
	{
		/**
		 * @override
		 */
		initProvider()
		{
			this.provider = new CopilotMentionProvider(this.getProviderOptions());
		}

		/**
		 * @return {object}
		 */
		getProviderOptions()
		{
			return {
				dialogId: this.dialogId,
				loadSearchProcessed: (dialogIdList, isStartServerSearch) => {
					if (isStartServerSearch)
					{
						if (!this.isLoading)
						{
							logger.log('Mention: show loader');
							this.showLoader();
						}

						this.drawItems(this.filterOnlyUser(dialogIdList));

						return;
					}

					if (this.isLoading)
					{
						logger.log('Mention: hide local loader');
						this.hideLoader();
					}

					this.drawItems(this.filterOnlyUser(dialogIdList));
				},
				loadSearchComplete: (dialogIdList, query) => {
					if (query !== this.curruntQuery)
					{
						return;
					}

					if (this.isLoading)
					{
						logger.log('Mention: hide server loader');
						this.hideLoader();
					}
					this.drawItems(this.filterOnlyUser(dialogIdList));
				},
			};
		}

		/**
		 * @desc filter item by string id 'chat'
		 * @param {Array<string>} itemIdList
		 * @return {Array<string>}
		 */
		filterOnlyUser(itemIdList)
		{
			return itemIdList.filter(((itemId) => !itemId.includes('chat')));
		}

		/**
		 * @override
		 */
		subscribeEvents()
		{
			BX.addCustomEvent(EventType.dialog.external.mention, this.externalMention);

			if (!this.canUse())
			{
				return;
			}

			this.view.textField.on(EventType.dialog.textField.changeState, this.changeTextStateHandler);
			this.view.mentionPanel.on('itemTap', this.mentionItemSelectedHandler);
		}

		/**
		 * @override
		 */
		unsubscribeEvents()
		{
			BX.removeCustomEvent(EventType.dialog.external.mention, this.externalMention);

			if (!this.canUse())
			{
				return;
			}

			this.view.textField.off(EventType.dialog.textField.changeState, this.changeTextStateHandler);
			this.view.mentionPanel.off('itemTap', this.mentionItemSelectedHandler);
		}

		/**
		 * @override
		 * @param {Array<string>} itemIds
		 */
		drawItems(itemIds)
		{
			const result = itemIds.map((itemId) => this.prepareItemForDrawing(itemId));

			if (this.isProcessed)
			{
				this.view.mentionPanel.setItems(result);
			}
			else
			{
				this.view.mentionPanel.open(result);

				this.isProcessed = true;
			}
		}

		/**
		 * @override
		 * @return {Array<string>}
		 */
		getRecentUsers()
		{
			return [];
		}
	}

	module.exports = { CopilotMentionManager };
});
