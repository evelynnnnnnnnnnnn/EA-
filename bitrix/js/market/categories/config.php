<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
{
	die();
}

return [
	'css' => 'dist/categories.bundle.css',
	'js' => 'dist/categories.bundle.js',
	'rel' => [
		'main.polyfill.core',
	],
	'skip_core' => true,
];