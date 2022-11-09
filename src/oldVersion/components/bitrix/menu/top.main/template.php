<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if (empty($arResult)) {
	return;
} ?>
<ul class="navbar-nav mr-4" style="margin-right: 0 !important;">
    <li class="mobile-location">
        <span class="location">Выберите город</span>
    </li>
	<?
	$n = 0;
	$count = count($arResult);
	foreach ($arResult as $arItem):
        $n++;
		$liClasses = [($count == $n) ? 'last' : ''];
		$liClasses[] = $arItem['PARAMS']['CLASS'];
        $liClass = implode(' ', array_filter($liClasses));

		$linkClasses = [$arItem["LINK"] == '#' ? 'nav-link-bold' : ''];
		$linkClasses[] = $arItem["SELECTED"] ? ' nav-link-activ' : '';
		$linkClass = implode(' ', array_filter($linkClasses));
		?>
        <li class="nav-item <?= $liClass ?>" data-href="<?= $arItem["LINK"] ?>" >
            <a class="nav-link <?= $linkClass ?>" href="<?= $arItem["LINK"] ?>" data-count=""><?= $arItem["TEXT"] ?></a>
        </li>
	<? endforeach; ?>
    <li class="nav-item manual-nav-item">
        <a href="/AnyPact инструкция.pdf" class="manual nav-link" target="_blank" onclick="ym(64629523,'reachGoal','manual');">Инструкция</a>
    </li>
</ul>