<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arItem */
?>
<div class="filter-item-block-list">
	<?foreach ($arItem["VALUES"] as $value):?>
		<label class="radio">
			<input type="radio" name="<?=$value['CONTROL_NAME_ALT']?>" value="<?=$value['HTML_VALUE_ALT']?>" <?=$value['CHECKED']?'checked':''?>>
			<span><?=$value['VALUE']?></span>
		</label>
	<?endforeach;?>
</div>
