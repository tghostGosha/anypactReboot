<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (empty($arResult)) {
	return;
}
$price = ($arResult['SHOW_PRICE'] && !empty($arResult['PRICE']))
	? number_format($arResult['PRICE'], 2, ',', ' ') . ' ₽'
	: 'Цена по запросу';
?>
<div class="item-card">
    <a href="<?=$arResult['URL']?>">
	    <?/**/?>
        <div class="item-card-img">
           <img src="<?=$arResult['PHOTO']?>" alt="">
        </div>
	    <?/*/?>
        <div class="item-card-img" style="background-image: url('<?=$arResult['PHOTO']?>')"></div>
	    <?/**/?>
    </a>

    <div class="item-card-info-block">
        <a href="<?=$arResult['URL']?>">
            <h3 title="<?=$arResult['NAME']?>"><?=TruncateText($arResult['NAME'], 30)?></h3>
        </a>

            <div class="item-card-price"><?= $price?></div>
            <div class="item-card-text"><?=$arResult['TEXT']?></div>
            <div class="item-card-date"><?=$arResult['DATE']?></div>


    </div>
</div>
