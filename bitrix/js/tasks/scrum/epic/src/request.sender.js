import {ajax, Loc} from 'main.core';
import {MessageBox} from 'ui.dialogs.messagebox';

type ErrorResponse = {
	data: string,
	errors: Array,
	status: string
}

export class RequestSender
{
	sendRequest(controller: string, action: string, data = {}): Promise
	{
		return new Promise((resolve, reject) => {
			ajax.runAction(
				'bitrix:tasks.scrum.' + controller + '.' + action,
				{
					data: data
				}
			).then(resolve, reject);
		});
	}

	showErrorAlert(response: ErrorResponse, alertTitle?: string)
	{
		if (Type.isUndefined(response.errors))
		{
			console.error(response);

			return;
		}

		if (response.errors.length)
		{
			const firstError = response.errors.shift();
			if (firstError)
			{
				const errorCode = (firstError.code ? firstError.code : '');

				const message = firstError.message + ' ' + errorCode;
				const title = (alertTitle ? alertTitle : Loc.getMessage('TSE_ERROR_POPUP_TITLE'));

				MessageBox.alert(message, title);
			}
		}
	}
}