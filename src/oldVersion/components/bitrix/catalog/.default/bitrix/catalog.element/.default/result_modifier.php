<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
function checkInBlackList($userId){
	global $USER;
	if($USER->IsAuthorized()){
		if(CModule::IncludeModule("highloadblock"))
		{
			$hlblock = Bitrix\Highloadblock\HighloadBlockTable::getById(15)->fetch();
			$entity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock);
			$entity_data_class = $entity->getDataClass();
			$rsData = $entity_data_class::getList(array(
				"select" => array("*"),
				"order" => array("ID" => "ASC"),
				"filter" => array("UF_USER_A" => $userId, "UF_USER_B" => $USER->GetID())
			));
			if($arData = $rsData->Fetch()){
				return true;
			}
		}
	}
	return false;
}

$userData = [];
$userFields = \Bitrix\Main\UserTable::getById($arResult['PROPERTIES']['PACT_USER']['VALUE'])->fetch();

$userData['NAME'] = $userFields['LAST_NAME'].' '.$userFields['NAME'];
$userData['CITY'] = $userFields['PERSONAL_CITY'];
$userData['ID'] = $userFields['ID'];

if(!empty($userFields['PERSONAL_PHOTO'])){
	$file = CFile::ResizeImageGet($userFields['PERSONAL_PHOTO'], array('width'=>68, 'height'=>68));
	$userData['PHOTO'] = $file['src'];
}
else{
	$userData['PHOTO'] = SITE_TEMPLATE_PATH. '/image/people-search-no-phpto.png';
}

$arResult['USER_PACT'] = $userData;


$arResult['BLACKLIST'] = checkInBlackList($userData['ID']);
global $USER;
if($USER->IsAuthorized()){
	$sort = [];
	$filter = [
		'ID' => $USER->GetID()
	];
	$select = [];
	$nav = ['nPageSize' => 1];
	$rsUsers = CUser::GetList(($by="personal_country"), ($order="desc"), $filter);
	if($user = $rsUsers->Fetch()){
		$arResult['USER_CURRENT'] = $user;
	}
}
$arResult['PRICE'] = (
	empty($arResult['PROPERTIES']['PRICE_ON_REQUEST']['VALUE']) &&
	!empty($arResult['PROPERTIES']['SUMM_PACT']['VALUE']))
	? number_format($arResult['PROPERTIES']['SUMM_PACT']['VALUE'], 2, ',', ' ') . ' ₽'
	: 'Цена по запросу';