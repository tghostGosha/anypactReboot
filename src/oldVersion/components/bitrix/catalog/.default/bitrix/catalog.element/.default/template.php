<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

/**
 * @global CMain                 $APPLICATION
 * @var array                    $arParams
 * @var array                    $arResult
 * @var CatalogSectionComponent  $component
 * @var CBitrixComponentTemplate $this
 * @var string                   $templateName
 * @var string                   $componentPath
 * @var string                   $templateFolder
 */

$this->setFrameMode(true);

unset($arResult['ORIGINAL_PARAMETERS']);
foreach ($arResult["PROPERTIES"]["INPUT_FILES"]['VALUE'] as $imgId) {
	$file = CFile::ResizeImageGet($imgId, ['width' => '180', 'height' => '110'], BX_RESIZE_IMAGE_EXACT);
	$resize_img = CFile::ResizeImageGet($imgId, ['width' => '730', 'height' => '500'], BX_RESIZE_IMAGE_PROPORTIONAL);
	$arr_img[] = [
		'URL' => $resize_img['src'],
		'THUMB_URL' => $file['src']
	];
}

$is_aut = true;
?>
..
<div class="row">
    <div class="col-md-7 col-lg-8">
        <? if (!empty($arr_img)): ?>
            <div class="slider-sdelka" id="my-slider">
                <div class="sp-slides">
                    <? foreach ($arr_img as $url_img): ?>
                        <? if (!empty($url_img['URL'])) : ?>
                            <div class="sp-slide" data-src="<?= $url_img["URL"] ?>">
                                <span class="gallery-img-cover"
                                      style="background-image: url('<?= $url_img["URL"] ?>');"></span>
                                <img class="sp-image" src="<?= $url_img["URL"] ?>">
                                <? if (count($arr_img) > 1): ?>
                                    <img class="sp-thumbnail" src="<?= $url_img['THUMB_URL'] ?>">
                                <? endif; ?>
                            </div>
                        <? endif; ?>
                    <? endforeach; ?>
                </div>
            </div>
        <? endif; ?>
        <? if (!empty($arResult['DETAIL_TEXT'])): ?>
            <h5>Описание</h5>
            <?= $arResult['DETAIL_TEXT'] ?>
        <?endif; ?>
        <? if (!empty($arResult['PROPERTIES']['CONDITIONS_PACT']['~VALUE']['TEXT'])): ?>
            <h5>Условия</h5>
            <?= $arResult['PROPERTIES']['CONDITIONS_PACT']['~VALUE']['TEXT'] ?>
        <?endif; ?>
        <?if(!empty($arResult['PROPERTIES']['COORDINATES_AD']['VALUE'])):?>
            <div class="map-block">
                <div id="map" style="height: 400px;" data-coordinates="<?=$arResult['PROPERTIES']['COORDINATES_AD']['VALUE']?>"></div>
                <div class="address-pact"></div>
            </div>
        <?endif;?>
        <div class="detail-share">
            <div class="ya-share2"
                 data-services="vkontakte,facebook,odnoklassniki,twitter,viber,whatsapp,telegram"></div>
        </div>
    </div>
    <div class="col-md-5 col-lg-4">
        <?include($_SERVER['DOCUMENT_ROOT'].$templateFolder.'/right-column.php')?>
    </div>
</div>
