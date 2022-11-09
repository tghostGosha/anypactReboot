<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
global $getGeo;
?>

<? if (empty($arResult['ITEMS'])) {
	return;
} ?>
<div class="city-choose" id="city_choose">
    <div class="container">
        <button class="city-choose-btn-close">Закрыть&nbsp;&nbsp;&nbsp;х</button>
        <h2>Выберите город</h2>
        <div class="row">
            <div class="col-md-12">
                <div class="row-column">
					<? foreach ($arResult['ITEMS'] as $city): ?>
						<?
						$class = ['city-choose-btn-city'];
						$class[] = ($city['PROPERTIES']['BOLD']['VALUE'] == 'Y') ? 'font-weight-bold' : '';
						$class[] = (!empty($city['PROPERTIES']['ALL_CITY']['VALUE'])) ? 'all_city' : '';
						$class = array_filter($class);
						?>
                        <div class="col-6 col-sm-4 col-md-6 col-xl-2">
                            <button class="<?= implode(' ', $class) ?>"><?= $city['NAME'] ?></button>
                        </div>
					<? endforeach ?>
                </div>
            </div>
            <div class="col-md-6"></div>
        </div>
        <span class="city-choose-form-header">Или введите в поле</span>
        <form class="sity-submit">
            <div class="row">
                <div class="col-md-6"><input type="text" class="sity-submit_input"
                                             placeholder="Введите город или населенный пункт (например &quot;Санкт-Петербург&quot;)">
                </div>
                <div class="col-md-6">
                    <button class="btn btn-nfk-invert city-choose-btn-choose">Выбрать</button>
                </div>
            </div>
        </form>
    </div>
</div>
