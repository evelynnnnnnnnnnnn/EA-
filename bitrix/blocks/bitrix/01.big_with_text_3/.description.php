<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
{
	die();
}

use Bitrix\Main\Localization\Loc;

return array(
	'block' => array(
		'name' => Loc::getMessage('LANDING_BLOCK_CVR003._NAME'),
		'section' => array('cover'),
		'dynamic' => false,
	),
	'cards' => array(),
	'nodes' => array(
		'.landing-block-node-img' => array(
			'name' => Loc::getMessage('LANDING_BLOCK_CVR003._NODES_LANDINGBLOCKNODE_IMG'),
			'type' => 'img',
			'editInStyle' => true,
			'allowInlineEdit' => false,
			'dimensions' => array('width' => 1920, 'height' => 1080),
			'create2xByDefault' => false,
			'isWrapper' => true,
		),
		'.landing-block-node-title' => array(
			'name' => Loc::getMessage('LANDING_BLOCK_CVR003._NODES_LANDINGBLOCKNODETITLE'),
			'type' => 'text',
		),
		'.landing-block-node-text' => array(
			'name' => Loc::getMessage('LANDING_BLOCK_CVR003._NODES_LANDINGBLOCKNODETEXT'),
			'type' => 'text',
		),
		'.landing-block-node-button' => array(
			'name' => Loc::getMessage('LANDING_BLOCK_CVR003._NODES_LANDINGBLOCKNODE_BUTTON'),
			'type' => 'link',
		),
	),
	'style' => array(
		'block' => array(
			'type' => ['block-default-background-height-vh'],
		),
		'nodes' => array(
			'.landing-block-node-container' => array(
				'name' => Loc::getMessage('LANDING_BLOCK_CVR003._NODES_LANDINGBLOCKNODE_CONTAINER'),
				'type' => ['text-align', 'animation'],
			),
			'.landing-block-node-button-container' => array(
				'name' => Loc::getMessage('LANDING_BLOCK_CVR003._NODES_LANDINGBLOCKNODE_BUTTON'),
				'type' => 'text-align',
			),
			'.landing-block-node-title' => array(
				'name' => Loc::getMessage('LANDING_BLOCK_CVR003._NODES_LANDINGBLOCKNODETITLE'),
				'type' => ['typo', 'heading'],
			),
			'.landing-block-node-text' => array(
				'name' => Loc::getMessage('LANDING_BLOCK_CVR003._NODES_LANDINGBLOCKNODETEXT'),
				'type' => 'typo',
			),
			'.landing-block-node-button' => array(
				'name' => Loc::getMessage('LANDING_BLOCK_CVR003._NODES_LANDINGBLOCKNODE_BUTTON'),
				'type' => 'button',
			),
		),
	),
);