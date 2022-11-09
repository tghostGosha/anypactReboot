<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var array $arParams */
/** @var array $arResult */
/** @var CBitrixComponentTemplate $this */

/** @var PageNavigationComponent $component */
$component = $this->getComponent();

$this->setFrameMode(true);


$endPage = $arResult["END_PAGE"] + 3;
$arResult["END_PAGE"] = ($endPage < $arResult['PAGE_COUNT'])?$endPage:$arResult['PAGE_COUNT'];

/*echo('<pre>');print_r($arResult['PAGE_COUNT']);echo('</pre>');
echo('<pre>');print_r($arResult['CURRENT_PAGE']);echo('</pre>');
echo('<pre>');print_r($arResult["START_PAGE"]);echo('</pre>');
echo('<pre>');print_r($arResult["END_PAGE"]);echo('</pre>');*/
/*echo('<pre>');print_r($arResult["START_PAGE"]);echo('</pre>');
echo('<pre>');print_r($arResult["END_PAGE"]);echo('</pre>');*/
/*if($arResult["START_PAGE"] > 1){

}
*/

/*$startPage = $arResult["START_PAGE"] - 3;
$arResult["START_PAGE"] = ($startPage < 1)?1:$startPage;*/
#$arResult["START_PAGE"]-=3;
?>

<div class="pagination-container">
    <ul>
        <? if ($arResult["CURRENT_PAGE"] > 1): ?>
            <? if ($arResult["CURRENT_PAGE"] > 2): ?>
                <li>
                    <a href="<?= htmlspecialcharsbx($component->replaceUrlTemplate($arResult["CURRENT_PAGE"] - 1)) ?>">
                        <img src="<?=$this->GetFolder()?>/img/nav_back.svg"/>
                    </a>
                </li>
            <? else: ?>
                <li>
                    <a href="<?= htmlspecialcharsbx($arResult["URL"]) ?>">
                        <img src="<?=$this->GetFolder()?>/img/nav_back.svg"/>
                    </a>
                </li>
            <? endif ?>
            <li><a href="<?= htmlspecialcharsbx($arResult["URL"]) ?>">1</a></li>
	        <?if($arResult["START_PAGE"] > 1):?>
                <li><span>...</span></li>
	        <?endif;?>
        <? else: ?>
            <li><img src="<?=$this->GetFolder()?>/img/nav_back.svg"/></li>
            <li><span>1</span></li>
        <? endif ?>

        <?
        $page = $arResult["START_PAGE"] + 1;
        while ($page <= $arResult["END_PAGE"] - 1):
            ?>
        <? if ($page == $arResult["CURRENT_PAGE"]):?>
            <li><span><?= $page ?></span></li>
        <? else:?>
            <li>
                <a href="<?= htmlspecialcharsbx($component->replaceUrlTemplate($page)) ?>"><?= $page ?></a>
            </li>
        <? endif ?>
            <? $page++ ?>
        <? endwhile ?>

        <? if ($arResult["CURRENT_PAGE"] < $arResult["PAGE_COUNT"]): ?>
            <? if ($arResult["PAGE_COUNT"] > 1): ?>
                <?if($arResult["END_PAGE"] < $arResult["PAGE_COUNT"]):?>
                    <li><span>...</span></li>
                <?endif;?>
                <li>
                    <a href="<?= htmlspecialcharsbx($component->replaceUrlTemplate($arResult["PAGE_COUNT"])) ?>">
                        <?= $arResult["PAGE_COUNT"] ?>
                    </a>
                </li>
            <? endif ?>
            <li>
                <a href="<?= htmlspecialcharsbx($component->replaceUrlTemplate($arResult["CURRENT_PAGE"] + 1)) ?>">
                    <img src="<?=$this->GetFolder()?>/img/nav_next.svg"/>
                </a>
            </li>
        <? else: ?>
            <? if ($arResult["PAGE_COUNT"] > 1): ?>
                <li><span><?= $arResult["PAGE_COUNT"] ?></span></li>
            <? endif ?>
            <li>
                <img src="<?=$this->GetFolder()?>/img/nav_next.svg"/>
            </li>
        <? endif ?>


    </ul>
</div>

