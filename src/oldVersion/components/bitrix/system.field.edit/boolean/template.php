<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? foreach ($arResult["VALUE"] as $res): ?>
    <div class="form-check mt-4 profile-box">
        <input type="hidden" value="0" name="<?= $arParams["arUserField"]["FIELD_NAME"] ?>">
        <label for="<?= $arParams["arUserField"]["FIELD_NAME"] ?>" class="radio-transform">
            <input type="checkbox" class="radio__input" name="<?= $arParams["arUserField"]["FIELD_NAME"] ?>" value="1" id="<?= $arParams["arUserField"]["FIELD_NAME"] ?>">
            <span class="radio__label" id="<?= $arParams["arUserField"]["FIELD_NAME"] ?>">Хочу участвовать в <a href="/promotion-2022" target="_blank">акции</a></span>
        </label>
    </div>
<? endforeach; ?>