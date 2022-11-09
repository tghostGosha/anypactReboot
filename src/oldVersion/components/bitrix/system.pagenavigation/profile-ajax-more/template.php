<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>
<? if ($arResult["NavPageCount"] > 1) : ?>

    <? if ($arResult["NavPageNomer"] + 1 <= $arResult["nEndPage"]) : ?>
        <?
        $plus = $arResult["NavPageNomer"] + 1;
        $url = $arResult["sUrlPathParams"] . "PAGEN_" . $arResult["NavNum"] . "=" . $plus;
        ?>
        <div class="col-md-12 text-center">
            <span data-url="<?= $url ?>" class="more-info-link"><?= GetMessage('SHOW_MORE') ?><span></span>
        </div>
    <? endif ?>

<? endif ?>