<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain                 $APPLICATION
 * @var array                    $arParams
 * @var array                    $arResult
 * @var CatalogSectionComponent  $component
 * @var CBitrixComponentTemplate $this
 * @var string                   $templateName
 * @var string                   $componentPath
 */
$this->setFrameMode(true);
$context = \Bitrix\Main\Context::getCurrent();
$request = $context->getRequest();
$isAjax = $request->isAjaxRequest();

$size=['width'=>300, 'height'=>300];

$idHash = 'bx-user-pacts-';
$idHash .= \Bitrix\Main\Security\Random::getString(7);
$listBlockId = $idHash.'-block';
$itemListId = $idHash.'-list';
$buttonId = $idHash.'-button';

if (empty($arResult['ITEMS'])) {
	return;
}

if (!empty($arResult['NAV_RESULT'])) {
	$navParams = [
		'NavPageCount' => $arResult['NAV_RESULT']->NavPageCount,
		'NavPageNomer' => $arResult['NAV_RESULT']->NavPageNomer,
		'NavNum' => $arResult['NAV_RESULT']->NavNum
	];
} else {
	$navParams = [
		'NavPageCount' => 1,
		'NavPageNomer' => 1,
		'NavNum' => $this->randString()
	];
}

$jsFields = [
	'source' => $APPLICATION->GetCurPageParam("", ["PAGEN_" . $navParams['NavNum']]),
	'navParams' => $navParams,
	'parentClass' => 'items-card-list',
	'itemListId' => $itemListId,
	'blockListId' => $listBlockId,
	'buttonId' => $buttonId,
	'buttonClass' => 'get-next',
	'idHash' => $idHash,
];
?>
<div id="<?=$listBlockId?>" class="new-profile_block new-profile_block-border">
    <div class="offers-block-header">
        <h2 class="count">Предложения <span>(<?=$arResult['NAV_RESULT']->NavRecordCount?>)</span></h2>
        <div class="search-advt-options">
            <div class="option-item">
                <div class="option-title">Вид объявлений</div>
                <ul class="option-variable">
                    <li>
                        <a href="javascript:void(0)" class="grid active">
                            <svg><use xlink:href="#grid-menu" /></svg>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="table">
                            <svg><use xlink:href="#table-menu" /></svg>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="items-card-list " id="<?=$itemListId?>">
		<?

		if ($isAjax) { $APPLICATION->RestartBuffer(); }

        foreach ($arResult['ITEMS'] as $item):
			$imgId = null;
			$img = '/local/templates/anypact/image/no_img_pacts.jpg';
			if (!empty($item['PREVIEW_PICTURE'])) {
				$imgId = $item['PREVIEW_PICTURE']['ID'];
			} elseif (!empty($item['DETAIL_PICTURE'])) {
				$imgId = $item['DETAIL_PICTURE']['ID'];
			} elseif (!empty($item['PROPERTIES']['INPUT_FILES']['VALUE'][0])) {
				$imgId = $item['PROPERTIES']['INPUT_FILES']['VALUE'][0];
			}
			if (!empty($imgId)) {
				$file = CFile::ResizeImageGet($imgId, ['width' => 250, 'height' => 250]);
				$img = $file['src'];
			}
			$APPLICATION->IncludeComponent("bitrix:catalog.item", "standard", [
				'RESULT' => [
					'NAME' => TruncateText($item['NAME'], 30),
					'PHOTO' => $img,
					'TEXT' => TruncateText(strip_tags($item['DETAIL_TEXT']), 145),
					'PRICE' => $item['PROPERTIES']['SUMM_PACT']['VALUE'],
					'SHOW_PRICE' => (empty($item['PROPERTIES']['PRICE_ON_REQUEST']['VALUE']) || !empty($item['PROPERTIES']['SUMM_PACT']['VALUE'])),
					'DATE' => $item['DATE_ACTIVE_FROM'],
					'URL' => $item['DETAIL_PAGE_URL'],
				],
			], false);
		endforeach;

		if ($isAjax) { die(); }

		?>
    </div>
    <?if($arResult['NAV_RESULT']->NavPageCount > 1):?>
        <div class="button-nav">
            <button class="get-next" id="<?=$buttonId?>">Показать еще</button>
        </div>
        <script>
			BX.userPactsList.init(<?=CUtil::PhpToJSObject($jsFields)?>);
        </script>
    <?endif;?>
</div>
