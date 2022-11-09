<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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


?>
<div class="filter-block">
    <form  action="<?= $arResult["FORM_ACTION"] ?>" method="get"
          class="">
		<? foreach ($arResult["HIDDEN"] as $arItem): ?>
            <input type="hidden" name="<?= $arItem["CONTROL_NAME"] ?>" id="<?= $arItem["CONTROL_ID"] ?>"
                   value="<?= $arItem["HTML_VALUE"] ?>"/>
		<? endforeach; ?>
		<? foreach ($arResult["ITEMS"] as $key => $arItem): ?>
			<?
			if (
				(empty($arItem["VALUES"]) || isset($arItem["PRICE"]))
                || (
					$arItem["DISPLAY_TYPE"] == "A"
					&& ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0)
				)
			) continue;
			?>
            <div class="filter-item">
                <div class="filter-item-title"><?= $arItem["NAME"] ?> :<?#=$arItem["DISPLAY_TYPE"]?></div>

                <?
                switch ($arItem["DISPLAY_TYPE"]){
                    case 'A':
                        $slider = true;
                        include(__DIR__.'/views/range.php');
                    break;
                    case 'B':
	                    $slider = false;
                        include(__DIR__.'/views/range.php');
                    break;
	                case "P":
                        include(__DIR__.'/views/drop-down.php');
                    break;
                    case "K":
	                    include(__DIR__.'/views/radio.php');
                    break;
	                case "U"://CALENDAR
		                include(__DIR__.'/views/calendar.php');
                    break;
                    default:
	                    include(__DIR__.'/views/checkbox.php');
                    break;
                }?>
            </div>
		<? endforeach; ?>
        <div class="filter-block-button">
            <input
                class="btn btn-nfk"
                type="submit"
                id="set_filter"
                name="set_filter"
                value="Показать"
            />
            <a style="display:block;padding:13px 0;margin-top:15px;" class="btn btn-nfk" href="<?=$arResult['FILTER_URL']?>">Сбросить</a>
            <input type="hidden" name="ajax" value="y" />
        </div>
        &nbsp;&nbsp;
    </form>
</div>
