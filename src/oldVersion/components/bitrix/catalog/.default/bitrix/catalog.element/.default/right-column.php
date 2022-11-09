<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
/**
 * @global CMain                 $APPLICATION
 * @var array                    $arParams
 * @var array                    $arResult
 * @var CatalogSectionComponent  $component
 * @var CBitrixComponentTemplate $this
 * @var string                   $templateName
 * @var string                   $componentPath
 * @var string                   $templateFolder
 */

?>

<span class="cardPact-price"><?=$arResult['PRICE']?></span>

<? if (!$arResult['BLACKLIST']) : ?>
	<? if (!empty($arResult['PROPERTIES']['SHOW_PHONE']['VALUE']) && !empty(str_replace(array("+", "-", "(", ")", " ", 8), '', $arResult["PROPERTIES"]["DEAL_PHONE"]["VALUE"]))) { ?>
		<div class="position-relative not_auth-error-block">
			<a href="#" class="btn btn-nfk cardPact-bBtn <?=(empty($arResult['USER_CURRENT']))?'disabled':'' ?>" id="show_phone" data-pact-id="<?= $arResult["ID"] ?>">Показать телефон<br>8(XXX) XXX-XX-XX</a>
			<? if (empty($arResult['USER_CURRENT'])) : ?>
				<div class="not_auth-error not_auth-error-phone">
					<span class="triangle" style="display: block; z-index: 1;">▲</span>
					<div>Для просмотра телефона необходимо <a id="open_reg_form" href="#">зарегистрироваться</a></div>
				</div>
			<? endif; ?>
		</div>
	<? } ?>

	<? //скрытие кнопки при окончане активности
	?>
	<? if (!empty($arResult['USER_CURRENT'])) : ?>
		<? if (!empty($arResult['PROPERTIES']['ID_DOGOVORA']['VALUE'])) : ?>
			<div class="position-relative not_auth-error-block">
				<a
					href="/contract/?ID=<?= $arResult["ID"] ?>"
					class="btn btn-nfk cardPact-bBtn <?=((!$arResult['USER_CURRENT']['UF_ESIA_AUT']))?'disabled':''?>"
					onclick="ym(64629523,'reachGoal','docs_link');">Посмотреть или подписать договор</a>
				<? if (!$arResult['USER_CURRENT']['UF_ESIA_AUT']) : ?>
					<div class="not_auth-error">
						<span class="triangle" style="display: block; z-index: 1;">▲</span>
						<div>Для подписания предложения необходимо <a target="__blank" href="/profile/#aut_esia">подтвердить свой аккаунт с помощью учетной записи портала Госуслуг</a></div>
					</div>
				<? endif; ?>
			</div>
		<? endif ?>
	<? endif ?>
<? endif; ?>

<!-- <a href="#" class="btn btn-nfk cardPact-bBtn">Посмотреть спецификацию</a> -->
<div class="cardPact-person">
	<a href="/profile_user/?ID=9858&amp;type=user">
		<img src="<?= $arResult['USER_PACT']['PHOTO'] ?>">
		<span><?= $arResult['USER_PACT']['NAME'] ?></span>
	</a>
	<br>
	<span class="text-gray"><?= $arResult['USER_PACT']['CITY'] ?></span><br>
</div>
<div class="cardPact-info">
	<br>
</div>
<?if(!empty($arResult['USER_CURRENT'])):?>
	<button class="btn btn-nfk d-block cardPact-bBtn open-form-message" onclick="ym(64629523,'reachGoal','message_post');">
		Написать сообщение
	</button>
	<button class="btn btn-nfk d-block cardPact-bBtn open-form-complaint"style="margin-top: 35px;">
		Пожаловаться на предложение
	</button>
<?endif;?>
