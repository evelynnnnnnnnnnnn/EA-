/**
 * @module im/messenger/provider/service/message
 */
jn.define('im/messenger/provider/service/message', (require, exports, module) => {
	const { LoadService } = require('im/messenger/provider/service/classes/message/load');
	const { ReactionService } = require('im/messenger/provider/service/classes/message/reaction');
	const { StatusService } = require('im/messenger/provider/service/classes/message/status');
	const { ActionService } = require('im/messenger/provider/service/classes/message/action');
	const { RichService } = require('im/messenger/provider/service/classes/message/rich');
	const { PinService } = require('im/messenger/provider/service/classes/message/pin');

	/**
	 * @class MessageService
	 */
	class MessageService
	{
		constructor({ store, chatId })
		{
			/** @type {MessengerCoreStore} */
			this.store = store;
			this.chatId = chatId;
			/** @type {LoadService} */
			this.loadService = null;
			/** @type {ReactionService} */
			this.reactionService = null;

			this.initServices();
		}

		static getMessageRequestLimit()
		{
			return LoadService.getMessageRequestLimit();
		}

		loadUnread()
		{
			return this.loadService.loadUnread();
		}

		loadHistory()
		{
			return this.loadService.loadHistory();
		}

		hasPreparedUnreadMessages()
		{
			return this.loadService.hasPreparedUnreadMessages();
		}

		hasPreparedHistoryMessages()
		{
			return this.loadService.hasPreparedHistoryMessages();
		}

		drawPreparedHistoryMessages()
		{
			return this.loadService.drawPreparedHistoryMessages();
		}

		drawPreparedUnreadMessages()
		{
			return this.loadService.drawPreparedUnreadMessages();
		}

		addReaction(reactionId, messageId)
		{
			return this.reactionService.add(reactionId, messageId);
		}

		removeReaction(reactionId, messageId)
		{
			return this.reactionService.remove(reactionId, messageId);
		}

		setReaction(reactionId, messageId)
		{
			return this.reactionService.set(reactionId, messageId);
		}

		deleteRichLink(messageId, attachId)
		{
			return this.richService.deleteRichLink(messageId, attachId);
		}

		updateText(message, text, dialogId)
		{
			return this.actionService.updateText(message, text, dialogId);
		}

		delete(message, dialogId)
		{
			return this.actionService.delete(message, dialogId);
		}

		openUsersReadMessageList(messageId)
		{
			this.statusService.openUsersReadMessageList(messageId);
		}

		createUsersReadCache()
		{
			this.statusService.createCache();
		}

		/**
		 * @param {number} messageId
		 */
		pinMessage(messageId)
		{
			return this.pinService.pinMessage(messageId);
		}

		/**
		 * @param {messageId} messageId
		 */
		unpinMessage(messageId)
		{
			return this.pinService.unpinMessage(messageId);
		}

		/**
		 * @private
		 */
		initServices()
		{
			this.loadService = new LoadService({
				chatId: this.chatId,
			});

			this.reactionService = new ReactionService({
				chatId: this.chatId,
			});

			this.statusService = new StatusService({
				store: this.store,
				chatId: this.chatId,
			});

			this.pinService = new PinService({
				chatId: this.chatId,
			});

			this.richService = new RichService();

			this.actionService = new ActionService();
		}
	}

	module.exports = {
		MessageService,
	};
});