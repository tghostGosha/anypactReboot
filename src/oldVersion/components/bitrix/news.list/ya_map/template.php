<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
if (!empty($arResult["ITEMS"])) {
    $arResData = array(
        "type" => "FeatureCollection",
        //"id" => 0,
    );
    foreach($arResult["ITEMS"] as $arItem) {
        if (!empty($arItem["DISPLAY_PROPERTIES"]["COORDINATES_AD"]["VALUE"])) {
            $arrCoor=explode(',',$arItem["DISPLAY_PROPERTIES"]["COORDINATES_AD"]["VALUE"]);
            $arResData['features'][] =  array(
                "type"  => "Feature",
                "id"    => intval($arItem['ID']),
                "geometry" => array (
                    "type"          => "Point",
                    "coordinates"   => [floatval($arrCoor[0]),floatval($arrCoor[1])],
                ),
                "properties" => array (
                    "balloonContent" => '<div class="baloon-content"><a href="'.$arItem['DETAIL_PAGE_URL'].'">'.$arItem['NAME'].'</a></div>',
                    "clusterCaption" => $arItem['NAME'],
                )
            );
            $arResData['IDS'][] = $arItem['ID'];
        }
    }
    echo json_encode($arResData);
}