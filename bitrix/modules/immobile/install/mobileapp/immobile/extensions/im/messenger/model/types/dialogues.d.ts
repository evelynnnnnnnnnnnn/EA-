import {DialogId} from "../../types/common";
import {MessengerModel, PayloadData} from "./base";
import {CommentModelCollection} from "./comment";

export enum DialogType {
	user = 'user',
	chat = 'chat',
	open = 'open',
	general = 'general',
	videoconf = 'videoconf',
	announcement = 'announcement',
	call = 'call',
	support24Notifier = 'support24Notifier',
	support24Question = 'support24Question',
	crm = 'crm',
	sonetGroup = 'sonetGroup',
	calendar = 'calendar',
	tasks = 'tasks',
	thread = 'thread',
	mail = 'mail',
	copilot = 'copilot',
	channel = 'channel',
	openChannel = 'openChannel',
	comment = 'comment',
}

export type DialoguesModelState = {
	dialogId: DialogId,
	chatId: number,
	type: DialogType,
	name: string,
	description: string,
	avatar: string,
	color: string,
	extranet: boolean,
	counter: number,
	userCounter: number,
	participants: Array<any>,
    lastLoadParticipantId: number,
	lastReadId: number,
	markedId: number,
	lastMessageId: number,
	lastMessageViews: LastMessageViews,
	savedPositionMessageId: number,
	managerList: Array<any>, //todo concrete type
	readList: Array<any>, //todo concrete type
	writingList: Array<WritingUserData>,
	muteList: Array<any>, //todo concrete type
	textareaMessage: string,
	quoteId: number,
	owner: number,
	entityType: string,
	entityId: string,
	dateCreate: Date | null,
	public: {
		code: string,
		link: string
	},
	inited: boolean,
	loading: boolean,
	hasPrevPage: boolean,
	hasNextPage: boolean,
	role: string,
	permissions: DialogPermissions,
	aiProvider: string,
	parentChatId: number,
	parentMessageId: number,
	messageCount: number,
};

export type LastMessageViews = {
	lastMessageViews: {
		countOfViewers: number,
		firstViewer: {
			date: string
			userId: number
			userName: string
		} | null,
		messageId: number,
	}
	isGroupDialog?: boolean,
}

export type WritingUserData = {
	userId: number
	userName: string
}

export type DialogPermissions = {
	manageUsersAdd: PermissionRoles,
	manageUsersDelete: PermissionRoles,
	manageUi: PermissionRoles,
	manageSettings: PermissionRoles,
	canPost?: PermissionRoles,
	manageMessages: PermissionRoles,
}

declare type PermissionRoles = 'guest' | 'member' | 'manager' | 'owner' | 'none';

declare type DialoguesModelCollection = {
	collection: Record<DialogId, DialoguesModelState>,
};

export type DialoguesMessengerModel = MessengerModel<DialoguesModelCollection>;


export type DialoguesModelActions =
	'dialoguesModel/setState'
	| 'dialoguesModel/set'
	| 'dialoguesModel/setFromLocalDatabase'
	| 'dialoguesModel/add'
	| 'dialoguesModel/update'
	| 'dialoguesModel/delete'
	| 'dialoguesModel/updateWritingList'
	| 'dialoguesModel/clearLastMessageViews'
	| 'dialoguesModel/incrementLastMessageViews'
	| 'dialoguesModel/setLastMessageViews'
	| 'dialoguesModel/decreaseCounter'
	| 'dialoguesModel/clearAllCounters'
	| 'dialoguesModel/addParticipants'
	| 'dialoguesModel/removeParticipants'
	| 'dialoguesModel/unmute'
	| 'dialoguesModel/mute'

export type DialoguesModelMutation =
	'dialoguesModel/add'
	| 'dialoguesModel/update'
	| 'dialoguesModel/delete'


export type DialoguesSetStateActions = 'setState';
export interface DialoguesSetStateData extends PayloadData
{
	collection: Record<DialogId, DialoguesModelState>,
}

export type DialoguesAddActions =
	'set'
	| 'add'
;
export interface DialoguesAddData extends PayloadData
{
	dialogId: DialogId;
	fields: DialoguesModelState;
}

export type DialoguesUpdateActions =
	'set'
	| 'update'
	| 'updateWritingList'
	| 'decreaseCounter'
	| 'updateUserCounter'
	| 'mute'
	| 'unmute'
	| 'addParticipants'
	| 'removeParticipants'
	| 'clearLastMessageViews'
	| 'incrementLastMessageViews'
	| 'setLastMessageViews'
	| 'clearAllCounters'
;
export interface DialoguesUpdateData extends PayloadData
{
	dialogId: DialogId,
	fields: Partial<DialoguesModelState>,
}

export type DialoguesDeleteActions = 'delete';
export interface DialoguesDeleteData extends PayloadData
{
	dialogId: DialogId,
}