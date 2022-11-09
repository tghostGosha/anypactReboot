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

?>
<?/*/?>
    <div class="items-card-list table-view">
<?/*/?>
    <div class="items-card-list ">
<?/**/?>
		<? foreach ($arResult['ITEMS'] as $item): ?>
			<?
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
				#
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
			?>
		<?endforeach; ?>
    </div>

    <div data-pagination-num="<?= $navParams['NavNum'] ?>">
		<?= $arResult['NAV_STRING'] ?>
    </div>
<?

