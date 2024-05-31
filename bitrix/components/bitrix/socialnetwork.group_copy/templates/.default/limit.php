<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
}

/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */

if (Bitrix\Main\Loader::includeModule('bitrix24'))
{
	\CBitrix24::showTariffRestrictionButtons('socnet_group_copy');
}