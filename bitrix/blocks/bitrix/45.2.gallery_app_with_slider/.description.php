<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
{
	die();
}

use Bitrix\Main\Localization\Loc;

return array(
	'block' => array(
		'name' => Loc::getMessage('LANDING_BLOCK_45.2.GALLERY_APP_WO_SLIDER_NAME_NEW'),
		'section' => array('image'),
		'dynamic' => false,
	),
	'cards' => array(
		'.landing-block-node-card' => array(
			'name' => Loc::getMessage('LANDING_BLOCK_45.2.GALLERY_APP_WO_SLIDER_CARDS_LANDINGBLOCKNODECARDIMG'),
			'label' => array('.landing-block-node-card-img', '.landing-block-node-card-title'),
		),
	),
	'nodes' => array(
		'.landing-block-node-card-img' => array(
			'name' => Loc::getMessage('LANDING_BLOCK_45.2.GALLERY_APP_WO_SLIDER_NODES_LANDINGBLOCKNODECARDIMG'),
			'type' => 'img',
			'useInDesigner' => false,
			'dimensions' => array('width' => 960, 'height' => 960),
			'disableLink' => true,
			'allowInlineEdit' => false,
			'create2xByDefault' => false,
		),
		'.landing-block-node-card-title' => array(
			'name' => Loc::getMessage('LANDING_BLOCK_45.2.GALLERY_APP_WO_SLIDER_NODES_LANDINGBLOCKNODECARDTITLE'),
			'type' => 'text',
		),
		'.landing-block-node-card-subtitle' => array(
			'name' => Loc::getMessage('LANDING_BLOCK_45.2.GALLERY_APP_WO_SLIDER_NODES_LANDINGBLOCKNODECARDSUBTITLE'),
			'type' => 'text',
		),
	),
	'style' => array(
		'.landing-block-node-card-title-container' => array(
			'name' => Loc::getMessage('LANDING_BLOCK_45.2.GALLERY_APP_WO_SLIDER_NODES_LANDINGBLOCKNODECARDTITLE_CONTAINER'),
			'type' => array('bg'),
		),
		'.landing-block-node-card-title' => array(
			'name' => Loc::getMessage('LANDING_BLOCK_45.2.GALLERY_APP_WO_SLIDER_NODES_LANDINGBLOCKNODECARDTITLE'),
			'type' => 'typo',
		),
		'.landing-block-node-card-subtitle' => array(
			'name' => Loc::getMessage('LANDING_BLOCK_45.2.GALLERY_APP_WO_SLIDER_NODES_LANDINGBLOCKNODECARDSUBTITLE'),
			'type' => 'typo',
		),
		'.landing-block-node-card' => array(
			'name' => Loc::getMessage('LANDING_BLOCK_45.2.GALLERY_APP_WO_SLIDER_CARDS_LANDINGBLOCKNODECARDIMG'),
			'type' => ['align-self', 'animation'],
		),
		'.landing-block-slider' => array(
			'additional' => [
				'name' => Loc::getMessage('LANDING_BLOCK_45_2_GALLERY_APP_WO_SLIDER_NODES_SLIDER'),
				'attrsType' => ['autoplay', 'autoplay-speed', 'animation', 'pause-hover', 'slides-show', 'dots'],
			]
		),
	),
	'assets' => array(
		'ext' => array('landing_carousel', 'landing_gallery_cards'),
	),
);