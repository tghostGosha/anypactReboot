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
?>


    <div class="owl-carousel owl-theme main-carousel_sdel">
		<?foreach ($arResult['SECTIONS'] as $section):?>
            <a href="<?=$section['SECTION_PAGE_URL']?>" class="item card-deal">
				<?if(!empty($arResult['UF_FIELDS'][$section['ID']]['UF_ICON'])):?>
                    <i class="icon-main <?=$arResult['UF_FIELDS'][$section['ID']]['UF_ICON']?>"></i>
				<?endif?>
                <h5 style="min-height: 54px;"><?=$section['NAME']?></h5>
                <p style="min-height: 160px; overflow: hidden;">
					<?=$section['DESCRIPTION']?>
                </p>
                <span class="card-deal__button">Перейти</span>
            </a>
		<?endforeach?>
    </div>
<? /*/ ?>
    <div class="owl-carousel owl-theme main-carousel_sdel">
		<?foreach ($arResult['SECTIONS'] as $section):?>

            <div class="item card-deal">
				<?if(!empty($arResult['UF_FIELDS'][$section['ID']]['UF_ICON'])):?>
                    <i class="icon-main <?=$arResult['UF_FIELDS'][$section['ID']]['UF_ICON']?>"></i>
				<?endif?>
                <h5 style="min-height: 54px;"><?=$section['NAME']?></h5>
                <p style="min-height: 160px; overflow: hidden;">
					<?=$section['DESCRIPTION']?>
                </p>
                <a href="<?=$section['SECTION_PAGE_URL']?>" class="card-deal__button">Перейти</a>
            </div>
		<?endforeach?>
    </div>
<? /**/ ?>



