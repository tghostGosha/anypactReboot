<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arItem */
/** @var array $arParams */
?>
<div class="filter-item-block-list drop-down-block ">
    <select name="<?=$arParams['FILTER_NAME']?>_<?=$arItem['ID']?>">
        <option value="">Выберите из списка</option>
        <?foreach ($arItem["VALUES"] as $value):?>
        <option value="<?=$value['HTML_VALUE_ALT']?>" <?=$value['CHECKED']?'selected':''?>><?=$value['VALUE']?></option>
        <?endforeach;?>
    </select>
    <?/*/?>
	<div class="bx-filter-select-container">
		<div class="bx-filter-select-block">
			<div class="bx-filter-select-text" data-role="currentOption">
				<?
				foreach ($arItem["VALUES"] as $val => $ar) {
					if ($ar["CHECKED"]) {
						echo $ar["VALUE"];
						$checkedItemExist = true;
					}
				}
				if (!$checkedItemExist) {
					echo GetMessage("CT_BCSF_FILTER_ALL");
				}
				?>
			</div>
			<div class="bx-filter-select-arrow"></div>
			<input
				style="display: none"
				type="radio"
				name="<?= $arCur["CONTROL_NAME_ALT"] ?>"
				id="<?= "all_" . $arCur["CONTROL_ID"] ?>"
				value=""
			/>
			<? foreach ($arItem["VALUES"] as $val => $ar): ?>
				<input
					style="display: none"
					type="radio"
					name="<?= $ar["CONTROL_NAME_ALT"] ?>"
					id="<?= $ar["CONTROL_ID"] ?>"
					value="<?= $ar["HTML_VALUE_ALT"] ?>"
					<?= $ar["CHECKED"] ? 'checked="checked"' : '' ?>
				/>
			<? endforeach ?>
			<div class="bx-filter-select-popup" data-role="dropdownContent"
			     style="display: none;">
				<ul>
					<li>
						<label for="<?= "all_" . $arCur["CONTROL_ID"] ?>"
						       class="bx-filter-param-label"
						       data-role="label_<?= "all_" . $arCur["CONTROL_ID"] ?>"
						       onclick="smartFilter.selectDropDownItem(this, '<?= CUtil::JSEscape("all_" . $arCur["CONTROL_ID"]) ?>')">
							<?= GetMessage("CT_BCSF_FILTER_ALL"); ?>
						</label>
					</li>
					<?
					foreach ($arItem["VALUES"] as $val => $ar):
						$class = "";
						if ($ar["CHECKED"])
							$class .= " selected";
						if ($ar["DISABLED"])
							$class .= " disabled";
						?>
						<li>
							<label for="<?= $ar["CONTROL_ID"] ?>"
							       class="bx-filter-param-label<?= $class ?>"
							       data-role="label_<?= $ar["CONTROL_ID"] ?>"
							       onclick="smartFilter.selectDropDownItem(this, '<?= CUtil::JSEscape($ar["CONTROL_ID"]) ?>')"><?= $ar["VALUE"] ?></label>
						</li>
					<? endforeach ?>
				</ul>
			</div>
		</div>
	</div>
	<?/**/?>
</div>
