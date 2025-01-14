import {Browser} from 'main.core';

export default class DesktopHelper
{
	static isSupportedDesktopApp(): boolean
	{
		return DesktopHelper.isBitrixDesktop() && DesktopHelper.geApiVersion() >= 67;
	}

	static isBitrixDesktop(): boolean
	{
		return navigator.userAgent.toLowerCase().includes('bitrixdesktop');
	}

	static geApiVersion(): number
	{
		if (typeof BXDesktopSystem === 'undefined')
		{
			return 0;
		}

		return Number(BXDesktopSystem.GetProperty('versionParts')[3]);
	}

	static isMainTab(): boolean
	{
		if (typeof BXDesktopSystem === 'undefined')
		{
			return false;
		}

		return typeof BX.desktop !== 'undefined' && BX.desktop.apiReady;
	}

	static isMac(): boolean
	{
		return Browser.isMac();
	}

	static isLinux(): boolean
	{
		return Browser.isLinux();
	}

	static isWindows(): boolean
	{
		return (
			Browser.isWin()
			|| (
				!Browser.isMac()
				&& !Browser.isLinux()
			)
		);
	}

	static isRunningOnAnyDevice(): boolean
	{
		return BXIM && BXIM.desktopStatus;
	}

	static checkRunningOnThisDevice(): Promise
	{
		return new Promise(resolve => {
			const turnedOnCallback: Function = () => {
				resolve(true);
			};

			const turnedOffCallback: Function = () => {
				resolve(false);
			};

			BX.desktopUtils.runningCheck(turnedOnCallback, turnedOffCallback);
		});
	}
}
