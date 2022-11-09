<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arResult */
/** @var array $arItem */
$min = $arItem["VALUES"]["MIN"];
$max = $arItem["VALUES"]["MAX"];
?>
<div class="filter-range-block">
    <input
        type="text"
        id="<?=$min['CONTROL_NAME']?>"
        name="<?=$min['CONTROL_NAME']?>"
        value="<?=$min['HTML_VALUE']?>"
        class="filter-date"
        data-form-name="<?= htmlspecialcharsbx(CUtil::JSEscape($arResult["FILTER_NAME"] . "_form")); ?>"
        data-current-time="<?=(time()+date("Z")+CTimeZone::GetOffset())?>"
    />
	    <?
        /*/
        $APPLICATION->IncludeComponent('bitrix:main.calendar', '', [
	        'FORM_NAME' => $arResult["FILTER_NAME"] . "_form",
	        'SHOW_INPUT' => 'Y',
	        'INPUT_ADDITIONAL_ATTR' => 'class="calendar" placeholder="' . FormatDate("SHORT", $arItem["VALUES"]["MIN"]["VALUE"]) . '" onkeyup="smartFilter.keyup(this)" onchange="smartFilter.keyup(this)"',
	        'INPUT_NAME' => $arItem["VALUES"]["MIN"]["CONTROL_NAME"],
	        'INPUT_VALUE' => $arItem["VALUES"]["MIN"]["HTML_VALUE"],
	        'SHOW_TIME' => 'N',
	        'HIDE_TIMEBAR' => 'Y',
        ], null, ['HIDE_ICONS' => 'Y']);
	    /**/
        ?>
    <div class="separator"> - </div>
    <input
            type="text"
            id="<?=$max['CONTROL_NAME']?>"
            name="<?=$max['CONTROL_NAME']?>"
            value="<?=$max['HTML_VALUE']?>"
            class="filter-date"
            data-form-name="<?= htmlspecialcharsbx(CUtil::JSEscape($arResult["FILTER_NAME"] . "_form")); ?>"
            data-current-time="<?=(time()+date("Z")+CTimeZone::GetOffset())?>"
    />

</div>
