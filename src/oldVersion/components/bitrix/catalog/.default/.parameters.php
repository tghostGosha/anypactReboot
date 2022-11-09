<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

/** @var array $arCurrentValues */

use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;
use Bitrix\Main\Web\Json;
use Bitrix\Iblock;


/*
$arTemplateParameters = array(
	"SECTIONS_VIEW_MODE" => array(
		#"PARENT" => "SECTIONS_SETTINGS",
		"NAME" => '#'.GetMessage('CPT_BC_SECTIONS_VIEW_MODE'),
		"TYPE" => "LIST",
		"VALUES" => [],
		"MULTIPLE" => "N",
		"DEFAULT" => "LIST",
		"REFRESH" => "Y"
	),
	"SECTIONS_SHOW_PARENT_NAME" => array(
		#"PARENT" => "SECTIONS_SETTINGS",
		"NAME" => '#'.GetMessage('CPT_BC_SECTIONS_SHOW_PARENT_NAME'),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y"
	)
);
*/