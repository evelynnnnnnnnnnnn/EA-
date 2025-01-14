<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
{
	die();
}

use Bitrix\Main\Localization\Loc;

return array(
	'block' => array(
		'name' => Loc::getMessage('LANDING_BLOCK_9_ONE_COL_FIX_TEXTS_BLOCKS_SLIDER_NAME'),
		'section' => array('tiles'),
	),
	'cards' => array(
		'.landing-block-card-slider-element' => array(
			'name' => Loc::getMessage('LANDING_BLOCK_9_ONE_COL_FIX_TEXTS_BLOCKS_SLIDER_CARDS_LANDINGBLOCKCARDSLIDERELEMENT'),
			'label' => array('.landing-block-node-element-title'),
		),
	),
	'nodes' => array(
		'.landing-block-node_bgimage' => array(
			'name' => Loc::getMessage('LANDING_BLOCK_9_ONE_COL_FIX_TEXTS_BLOCKS_SLIDER_NODES_LANDINGBLOCKNODE_BGIMAGE'),
			'type' => 'img',
			'editInStyle' => true,
			'allowInlineEdit' => false,
			'dimensions' => array('width' => 1920, 'height' => 1080),
		),
		'.landing-block-node-element-title' => array(
			'name' => Loc::getMessage('LANDING_BLOCK_9_ONE_COL_FIX_TEXTS_BLOCKS_SLIDER_NODES_LANDINGBLOCKNODEELEMENTTITLE'),
			'type' => 'text',
		),
		'.landing-block-node-element-text' => array(
			'name' => Loc::getMessage('LANDING_BLOCK_9_ONE_COL_FIX_TEXTS_BLOCKS_SLIDER_NODES_LANDINGBLOCKNODEELEMENTTEXT'),
			'type' => 'text',
		),
		'.landing-block-node-element-button' => array(
			'name' => Loc::getMessage('LANDING_BLOCK_9_ONE_COL_FIX_TEXTS_BLOCKS_SLIDER_NODES_BLOCKNODEELEMENTBUTTON'),
			'type' => 'link',
		),
	),
	'style' => array(
		'block' => array(
			'type' => array('block-default-wo-background'),
		),
		'nodes' => array(
			'.landing-block-card-slider-element' => array(
				'name' => Loc::getMessage('LANDING_BLOCK_9_ONE_COL_FIX_TEXTS_BLOCKS_SLIDER_CARDS_LANDINGBLOCKCARDSLIDERELEMENT'),
				'type' => array('align-self'),
			),
			'.landing-block-node-element-title' => array(
				'name' => Loc::getMessage('LANDING_BLOCK_9_ONE_COL_FIX_TEXTS_BLOCKS_SLIDER_STYLE_LANDINGBLOCKNODEELEMENTTITLE'),
				'type' => ['typo', 'animation', 'heading'],
			),
			'.landing-block-node-element-text' => array(
				'name' => Loc::getMessage('LANDING_BLOCK_9_ONE_COL_FIX_TEXTS_BLOCKS_SLIDER_STYLE_LANDINGBLOCKNODEELEMENTTEXT'),
				'type' => array('typo', 'animation'),
			),
			'.landing-block-node-element-button' => array(
				'name' => Loc::getMessage('LANDING_BLOCK_9_ONE_COL_FIX_TEXTS_BLOCKS_SLIDER_NODES_BLOCKNODEELEMENTBUTTON'),
				'type' => array('button', 'animation'),
			),
			'.landing-block-node_bgimage' => array(
				'name' => Loc::getMessage('LANDING_BLOCK_9_ONE_COL_FIX_TEXTS_BLOCKS_SLIDER_NODES_LANDINGBLOCKNODE_BGIMAGE'),
				'type' => ['background'],
			),
			'.landing-block-node-button-container' => array(
				'name' => Loc::getMessage('LANDING_BLOCK_25_BUTTON_AREA'),
				'type' => 'text-align',
			),
			'.landing-block-slider' => [
				'additional' => [
					'name' => Loc::getMessage('LANDING_BLOCK_9_ONE_COL_FIX_TEXTS_BLOCKS_SLIDER_STYLE_SLIDER'),
					'attrsType' => ['autoplay', 'autoplay-speed', 'animation', 'pause-hover', 'slides-show', 'arrows', 'dots'],
				]
			],
		),
	),
	'assets' => array(
		'ext' => array('landing_carousel'),
	),
);