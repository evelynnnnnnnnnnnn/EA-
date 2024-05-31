import {Dom} from 'main.core';

import './style.css';
import { NodeFormatter, type NodeFormatterOptions } from 'ui.bbcode.formatter';

export class TableNodeFormatter extends NodeFormatter
{
	constructor(options: NodeFormatterOptions = {})
	{
		super({
			name: 'table',
			convert(): HTMLTableElement {
				return Dom.create({
					tag: 'table',
					attrs: {
						classname: 'ui-formatter-table',
					},
				});
			},
			...options,
		});
	}
}