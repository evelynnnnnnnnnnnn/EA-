import {BaseEvent, EventEmitter} from 'main.core.events';
import {Cache, Dom, Tag, Text, Type} from 'main.core';

import './css/style.css';
import {type Field} from '../types/field';

type ListItemOptions = {
	field: Field,
	selected?: boolean,
	targetContainer?: HTMLElement,
	events?: {
		onChange?: (event: BaseEvent) => void,
	},
	type: $Values<ListItem.Type>,
	disabled?: boolean,
};

export default class ListItem extends EventEmitter
{
	static Type = {
		CHECKBOX: 'checkbox',
		RADIO: 'radio',
	};

	#cache = new Cache.MemoryCache();

	constructor(options: ListItemOptions)
	{
		super();
		this.setEventNamespace('BX.Crm.Form.Field.Selector.ListItem');
		this.subscribeFromOptions(options.events);
		this.#setOptions(options);

		const {targetContainer} = options;
		if (Type.isDomNode(targetContainer))
		{
			this.renderTo(targetContainer);
		}
	}

	#setOptions(options: ListItemOptions)
	{
		this.#cache.set('options', {type: ListItem.Type.CHECKBOX, ...options});
	}

	#getOptions(): ListItemOptions
	{
		return this.#cache.get('options', {});
	}

	getField(): Field
	{
		return this.#getOptions().field;
	}

	#onChange()
	{
		this.emit('onChange');
	}

	#getCheckbox(): HTMLInputElement
	{
		return this.#cache.remember('checkbox', () => {
			return Tag.render`
				<input 
					type="${Text.encode(this.#getOptions().type)}" 
					class="ui-ctl-element"
					onchange="${this.#onChange.bind(this)}"
					name="CRM_FIELDS_SELECTOR_ITEM"
					${this.#getOptions().selected ? 'checked' : ''}
				>
			`;
		});
	}

	isSelected(): boolean
	{
		return this.#getCheckbox().checked;
	}

	#isDisabled(): boolean
	{
		return this.#getOptions().disabled ?? false;
	}

	getLayout(): HTMLDivElement
	{
		return this.#cache.remember(`layout`, () => {
			const fieldDisabledClassName = 'crm-form-fields-selector-field--disabled';
			return Tag.render`
				<div class="crm-form-fields-selector-field${this.#isDisabled() ? " " + fieldDisabledClassName : ''}">
					<label class="ui-ctl ui-ctl-checkbox crm-form-fields-selector-field-checkbox">
						${this.#getCheckbox()}
						<div class="ui-ctl-label-text">${Text.encode(this.#getOptions().field.caption)}</div>
					</label>
				</div>
			`;
		});
	}

	renderTo(targetContainer: HTMLElement)
	{
		if (Type.isDomNode(targetContainer))
		{
			Dom.append(this.getLayout(), targetContainer);
		}
	}
}