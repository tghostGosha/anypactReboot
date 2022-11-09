<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$minData = $arItem["VALUES"]["MIN"];
$maxData = $arItem["VALUES"]["MAX"];
$minValue = (!empty($minData["HTML_VALUE"]))?$minData["HTML_VALUE"]:$minData["VALUE"];
$maxValue = (!empty($maxData["HTML_VALUE"]))?$maxData["HTML_VALUE"]:$maxData["VALUE"];


?>
<div class="selector"></div>
<div class="filter-range-block">
    <input
            class="min-price"
            type="text"
            name="<?= $arItem["VALUES"]["MIN"]["CONTROL_NAME"] ?>"
            id="<?= $arItem["VALUES"]["MIN"]["CONTROL_ID"] ?>"
            value="<?= $minData["HTML_VALUE"] ?>"
            placeholder="<?=$minData["VALUE"]?>"
            size="5"
    />
    <span class="separator">-</span>
    <input
        class="max-price"
        type="text"
        name="<?= $arItem["VALUES"]["MAX"]["CONTROL_NAME"] ?>"
        id="<?= $arItem["VALUES"]["MAX"]["CONTROL_ID"] ?>"
        value="<?= $maxData["HTML_VALUE"] ?>"
        placeholder="<?=$maxData["VALUE"]?>"
        size="5"
    />
    <?if($slider):?>
        <div
            class="filter-range-slider"
            data-max="<?=$maxData['VALUE']?>"
            data-min="<?=$minData['VALUE']?>"
        ></div>
    <?endif;?>
</div>

