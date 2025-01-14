import {Type} from 'main.core';

export type SchemeItemData = {
	id: string,
	name: string,
	entityTypeIds: number[],
	phrase: string,
	availabilityLock?: string,
};

/**
 * @memberOf BX.Crm.Conversion
 */
export class SchemeItem
{
	#id: string;
	#name: string;
	#entityTypeIds: number[];
	#phrase: string;
	#availabilityLock: string;

	constructor(params: SchemeItemData)
	{
		this.#id = String(params.id);
		this.#name = String(params.name);
		this.#phrase = String(params.phrase);
		this.#availabilityLock = String(params.availabilityLock);

		this.#entityTypeIds = [];
		if (Type.isArray(params.entityTypeIds))
		{
			params.entityTypeIds.forEach((entityTypeId) => {
				this.#entityTypeIds.push(Number(entityTypeId));
			});
		}
	}

	getId(): string
	{
		return this.#id;
	}

	getName(): string
	{
		return this.#name;
	}

	getEntityTypeIds(): number[]
	{
		return this.#entityTypeIds;
	}

	getPhrase(): string
	{
		return this.#phrase;
	}

	getAvailabilityLock(): string
	{
		return this.#availabilityLock;
	}
}
