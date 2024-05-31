/**
 * @module bizproc/workflow/list/item
 */
jn.define('bizproc/workflow/list/item', (require, exports, module) => {
	const { Loc } = require('loc');
	const { Base } = require('layout/ui/simple-list/items/base');

	const { shortTime, dayMonth, longDate } = require('utils/date/formats');
	const { FriendlyDate } = require('layout/ui/friendly-date');

	const { WorkflowFaces } = require('bizproc/workflow/faces');
	const { TaskButtons } = require('bizproc/task/buttons');

	const AppTheme = require('apptheme');
	const { mergeImmutable } = require('utils/object');

	/**
	 * @class WorkflowItem
	 */
	class WorkflowItem extends Base
	{
		constructor(props)
		{
			super(props);

			this.styles = mergeImmutable(this.styles, styles); // todo: override render()
		}

		/**
		 * @private
		 * @return View
		 */
		renderItemContent()
		{
			return View(
				{
					style: this.styles.itemContent,
				},
				this.renderHeader(),
				this.renderMenuIcon(),
				this.renderCounters(),
				this.renderBody(),
			);
		}

		/**
		 * @private
		 * @returns View
		 */
		renderMenuIcon()
		{
			return View(
				{
					style: this.styles.menuContainer,
				},
				ImageButton({
					testId: `${this.testId}_CONTEXT_MENU_BTN`,
					style: this.styles.menu,
					svg: {
						content: svgImages.disabledMenu,
					},
					onClick: () => this.showMenuNotify(),
				}),
			);
		}

		renderCounters()
		{
			const { data } = this.props.item;

			if (data.tasks.length === 0)
			{
				return null;
			}

			return Text(
				{
					style: this.styles.tasksCounter,
					text: String(data.tasks.length),
				},
			);
		}

		/**
		 * @private
		 * @returns View
		 */
		renderHeader()
		{
			return this.renderItemName();
		}

		/**
		 * Implement this method in child class if you need to change item body layout
		 *
		 * @private
		 * @returns View
		 */
		renderBody()
		{
			const { data } = this.props.item;
			const hasTasks = data.tasks.length > 0;

			return View(
				{},
				this.renderTypeName(),
				this.renderTime(),
				this.renderWorkflowFaces(data.id, data.faces),
				!hasTasks && this.renderStatus(),
				hasTasks && this.renderTaskButtons(),
			);
		}

		renderItemName()
		{
			const { data } = this.props.item;

			return View(
				{},
				Text({
					testId: `${this.testId}_ITEM_NAME`,
					text: jnComponent.convertHtmlEntities(data.itemName),
					style: this.styles.itemName,
					numberOfLines: 2,
					ellipsize: 'end',
				}),
			);
		}

		renderTypeName()
		{
			const { data } = this.props.item;

			return View(
				{
					testId: `${this.testId}_TYPE`,
					style: this.styles.header,
				},
				Text({
					testId: `${this.testId}_TYPE_NAME`,
					style: this.styles.title,
					text: (data.typeName || '').toLocaleUpperCase(env.languageId),
					numberOfLines: 1,
					ellipsize: 'end',
				}),
			);
		}

		renderTime()
		{
			const { data } = this.props.item;

			if (!data.itemTime)
			{
				return null;
			}

			return new FriendlyDate({
				timestamp: data.itemTime,
				timeSeparator: ' ',
				defaultFormat: (moment) => {
					const day = moment.format(moment.inThisYear ? dayMonth() : longDate());
					const time = moment.format(shortTime);

					return `${day} ${time}`;
				},
				showTime: true,
				useTimeAgo: false,
				style: {
					fontWeight: '400',
					fontSize: 13,
					color: AppTheme.colors.base4,
					marginRight: 60,
					marginLeft: 13,
				},
			});
		}

		renderWorkflowFaces(workflowId, faces)
		{
			return View(
				{
					style: this.styles.workflowFaces,
					onClick: () => {
						void requireLazy('bizproc:workflow/timeline').then(({ WorkflowTimeline }) => {
							void WorkflowTimeline.open(
								this.props.layout,
								{
									workflowId,
									taskId: this.props.item.data.tasks.at(0)?.id,
								},
							);
						});
					},
				},
				new WorkflowFaces({
					layout: this.props.layout,
					workflowId,
					faces,
				}),
			);
		}

		renderStatus()
		{
			const { data } = this.props.item;

			return View(
				{
					style: this.styles.statusWrap,
				},
				Text({
					text: Loc.getMessage('BPMOBILE_WORKFLOW_LIST_STATUS'),
					style: this.styles.statusTitle,
				}),
				Text({
					testId: `${this.testId}_STATUS_TEXT`,
					text: data.statusText,
					style: this.styles.statusText,
					numberOfLines: 1,
					ellipsize: 'end',
				}),
			);
		}

		renderTaskButtons()
		{
			const { data } = this.props.item;
			const task = data.tasks[0];

			return View(
				{
					style: this.styles.taskButtons,
				},
				new TaskButtons({
					task: { ...task, workflowId: data.id },
					isInline: true,
					title: data.typeName,
				}),
			);
		}

		showMenuNotify()
		{
			// eslint-disable-next-line no-undef
			InAppNotifier.showNotification({
				backgroundColor: AppTheme.colors.baseBlackFixed,
				message: Loc.getMessage('BPMOBILE_WORKFLOW_LIST_ITEM_MENU_EMPTY'),
				code: 'bp-workflow-item-menu',
				time: 3,
			});
		}
	}

	const svgImages = {
		menu: {
			content: '<svg width="21" height="5" viewBox="0 0 21 5" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4.83871 2.41935C4.83871 3.75553 3.75553 4.83871 2.41935 4.83871C1.08318 4.83871 0 3.75553 0 2.41935C0 1.08318 1.08318 0 2.41935 0C3.75553 0 4.83871 1.08318 4.83871 2.41935Z" fill="%color%"/><path d="M10.1613 4.83871C11.4975 4.83871 12.5806 3.75553 12.5806 2.41935C12.5806 1.08318 11.4975 0 10.1613 0C8.82512 0 7.74194 1.08318 7.74194 2.41935C7.74194 3.75553 8.82512 4.83871 10.1613 4.83871Z" fill="%color%"/><path d="M17.9032 4.83871C19.2394 4.83871 20.3226 3.75553 20.3226 2.41935C20.3226 1.08318 19.2394 0 17.9032 0C16.5671 0 15.4839 1.08318 15.4839 2.41935C15.4839 3.75553 16.5671 4.83871 17.9032 4.83871Z" fill="%color%"/></svg>',
		},
		disabledMenu: (() => {
			const fillBack = AppTheme.colors.base8;
			const fillFore = AppTheme.colors.base7;

			return `
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
					<rect x="2.3" y="2.3" width="19.4" height="19.4" rx="1.2" fill="${fillBack}" stroke="${fillFore}" stroke-width="1.6"/>
				</svg>
			`;
		})(),
	};
	const styles = {
		wrapper: {
			backgroundColor: AppTheme.colors.bgPrimary,
			paddingTop: 12,
		},
		item: {
			position: 'relative',
			backgroundColor: AppTheme.colors.bgContentPrimary,
			borderRadius: 12,
			paddingHorizontal: 12,
		},
		itemContent: {
			paddingTop: 17,
			paddingBottom: 8,
		},
		header: {
			flexDirection: 'column',
			marginRight: 60,
			marginLeft: 13,
		},
		title: {
			color: AppTheme.colors.base4,
			fontWeight: '400',
			fontSize: 12,
			height: 18,
			marginRight: 48,
			marginBottom: 8,
		},
		itemName: {
			fontWeight: '600',
			fontSize: 17,
			color: AppTheme.colors.base1,
			marginLeft: 13,
			marginRight: 60,
			marginBottom: 6,
			lineHeightMultiple: 1.15,
		},
		workflowFaces: {
			marginVertical: 8,
		},
		menu: {
			width: 24,
			height: 24,
		},
		menuContainer: {
			position: 'absolute',
			top: 19.5,
			right: 14.5,
			width: 24,
			height: 24,
			justifyContent: 'center',
			alignItems: 'center',
		},
		tasksCounter: {
			position: 'absolute',
			top: 69,
			right: 17,
			width: 18,
			height: 18,
			borderRadius: 9,
			backgroundColor: AppTheme.colors.accentMainAlert,
			textAlign: 'center',
			color: AppTheme.colors.baseWhiteFixed,
			fontSize: 12,
			fontWeight: '500',
		},
		taskButtons: {
			marginHorizontal: 13,
			paddingTop: 17,
			paddingBottom: 14,
		},
		statusWrap: {
			marginHorizontal: 13,
			paddingTop: 17,
			paddingBottom: 9,
		},
		statusTitle: {
			fontSize: 11,
			height: 14,
			fontWeight: '400',
			color: AppTheme.colors.base4,
		},
		statusText: {
			fontSize: 14,
			height: 19,
			fontWeight: '400',
			color: AppTheme.colors.base1,
			marginBottom: 8,
		},
	};

	module.exports = { WorkflowItem };
});