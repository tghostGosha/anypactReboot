<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Page\Asset;
use Bitrix\Main\UI\Extension;

global $USER, $APPLICATION, $getGeo;

CJSCore::Init(['jquery3', 'popup', 'date']);
Extension::load('ui.bootstrap4');

$asset = Asset::getInstance();

$asset->addCss(SITE_TEMPLATE_PATH . '/css/bootstrap.css');
$asset->addCss(SITE_TEMPLATE_PATH . '/template_style.css');
$asset->addCss(SITE_TEMPLATE_PATH . '/css/slider-pro.min.css');
$asset->addCss('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css');
$asset->addCss(SITE_TEMPLATE_PATH . '/css/owl.carousel.min.css');
$asset->addCss(SITE_TEMPLATE_PATH . '/css/owl.theme.default.css');
$asset->addCss(SITE_TEMPLATE_PATH . '/module/cropper/cropper.min.css');
$asset->addCss(SITE_TEMPLATE_PATH . '/module/selectize/selectize.css');
$asset->addCss(SITE_TEMPLATE_PATH . '/css/jquery.datetimepicker.css');
$asset->addCss(SITE_TEMPLATE_PATH . '/css/croppie.css');
$asset->addCss('https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css');
$asset->addCss(SITE_TEMPLATE_PATH . '/css/emoji.css');
$asset->addCss(SITE_TEMPLATE_PATH . '/module/lightGallery-master/dist/css/lightgallery.min.css');
$asset->addCss(SITE_TEMPLATE_PATH . '/css/propmption_popup.css');
$asset->addCss(SITE_TEMPLATE_PATH . '/css/promotion_2022/style.css');
$asset->addCss(SITE_TEMPLATE_PATH . '/css/fix.css', true);

$asset->addString('<script src="https://yastatic.net/share2/share.js" async="async"></script>', true);

#$asset->addJs(SITE_TEMPLATE_PATH . '/module/jquery/jquery-3.3.1.min.js');
$asset->addJs(SITE_TEMPLATE_PATH . '/module/selectize/selectize.min.js');
#$asset->addJs(SITE_TEMPLATE_PATH . '/js/bootstrap.js');
$asset->addJs(SITE_TEMPLATE_PATH . '/js/jquery.sliderPro.js');
$asset->addJs(SITE_TEMPLATE_PATH . '/js/owl.carousel.min.js');
$asset->addJs(SITE_TEMPLATE_PATH . '/module/cropper/cropper.min.js');
$asset->addJs(SITE_TEMPLATE_PATH . '/module/jquery.hotkeys/script.js');
$asset->addJs(SITE_TEMPLATE_PATH . '/module/jquery.maskedinput/jquery.inputmask.min.js');
$asset->addJs(SITE_TEMPLATE_PATH . '/module/jquery.validation/jquery.validate.min.js');
$asset->addJs(SITE_TEMPLATE_PATH . '/js/jquery.datetimepicker.js');
$asset->addJs(SITE_TEMPLATE_PATH . '/module/jquery.ui/jquery-ui.js');
$asset->addJs(SITE_TEMPLATE_PATH . '/js/new_popup.js');
$asset->addJs(SITE_TEMPLATE_PATH . '/js/croppie.min.js');
$asset->addJs(SITE_TEMPLATE_PATH . '/js/config.js');
$asset->addJs(SITE_TEMPLATE_PATH . '/js/util.js');
$asset->addJs(SITE_TEMPLATE_PATH . '/js/jquery.emojiarea.js');
$asset->addJs(SITE_TEMPLATE_PATH . '/js/emoji-picker.js');
$asset->addJs(SITE_TEMPLATE_PATH . '/module/lightGallery-master/dist/js/lightgallery.min.js');
$asset->addJs(SITE_TEMPLATE_PATH . '/module/lightGallery-master/modules/lg-zoom.min.js');
$asset->addJs(SITE_TEMPLATE_PATH . '/module/lightGallery-master/modules/lg-fullscreen.min.js');
$asset->addJs(SITE_TEMPLATE_PATH . '/module/lightGallery-master/modules/lg-thumbnail.min.js');
$asset->addJs(SITE_TEMPLATE_PATH . '/js/propmption_popup.js');
$asset->addJs(SITE_TEMPLATE_PATH . '/js/action.js', true);

?>
<!DOCTYPE html>
<html xml:lang="<?= LANGUAGE_ID ?>" lang="<?= LANGUAGE_ID ?>" class="<? $APPLICATION->ShowProperty('HtmlClass'); ?>">
<head>
	<? $APPLICATION->ShowProperty('AfterHeadOpen'); ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><? $APPLICATION->ShowTitle(); ?></title>
	<?
	$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . "/include/fonts.php", [], ["MODE" => "html"]);
	$APPLICATION->ShowHead();
	?>
    <!-- Google Tag Manager -->
    <script>(function (w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start':
                    new Date().getTime(), event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-WWQFXKG');</script>
    <!-- End Google Tag Manager -->
    <!-- Yandex.Metrika counter -->
    <script type="text/javascript">
        (function (m, e, t, r, i, k, a) {
            m[i] = m[i] || function () {
                (m[i].a = m[i].a || []).push(arguments)
            };
            m[i].l = 1 * new Date();
            k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(k, a)
        })
        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

        ym(64629523, "init", {
            clickmap: true,
            trackLinks: true,
            accurateTrackBounce: true,
            webvisor: true
        });
    </script>
    <noscript>
        <div><img src="https://mc.yandex.ru/watch/64629523" style="position:absolute; left:-9999px;" alt=""/></div>
    </noscript>
    <!-- /Yandex.Metrika counter -->
</head>
<?
$page = explode('/', $_SERVER['REQUEST_URI']);
$class_container = '';
if (!empty($page[1]) && $page[1] == 'pacts') {
	$class_container = 'bg-russia';
}
if (!empty($page[2]) && $page[2] == 'view_pact') {
	$class_container = '';
}
?>
<body class="<?= $class_container ?>">
<?

if ($USER->IsAdmin() && $APPLICATION->GetCurDir() !== '/messenger/') {
	//$APPLICATION->IncludeComponent("bitrix:im.messenger", "", Array(), null, array("HIDE_ICONS" => "Y"));
}
?>
<div id="panel"><? $APPLICATION->ShowPanel(); ?></div>
<?
$GLOBALS['filterCityViewList'] = ['!PROPERTY_DISPLAY_LIST' => false];
$APPLICATION->IncludeComponent("bitrix:news.list", "city.list", [
	"ACTIVE_DATE_FORMAT" => "d.m.Y",
	"ADD_SECTIONS_CHAIN" => "N",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_ADDITIONAL" => "",
	"AJAX_OPTION_HISTORY" => "N",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"CACHE_FILTER" => "Y",
	"CACHE_GROUPS" => "Y",
	"CACHE_TIME" => "36000000",
	"CACHE_TYPE" => "A",
	"CHECK_DATES" => "Y",
	"DETAIL_URL" => "",
	"DISPLAY_BOTTOM_PAGER" => "N",
	"DISPLAY_DATE" => "N",
	"DISPLAY_NAME" => "Y",
	"DISPLAY_PICTURE" => "N",
	"DISPLAY_PREVIEW_TEXT" => "N",
	"DISPLAY_TOP_PAGER" => "N",
	"FIELD_CODE" => [
		0 => "",
		1 => "",
	],
	"FILTER_NAME" => "filterCityViewList",
	"HIDE_LINK_WHEN_NO_DETAIL" => "N",
	"IBLOCK_ID" => "7",
	"IBLOCK_TYPE" => "sprav",
	"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
	"INCLUDE_SUBSECTIONS" => "Y",
	"MESSAGE_404" => "",
	"NEWS_COUNT" => "9999",
	"PAGER_BASE_LINK_ENABLE" => "N",
	"PAGER_DESC_NUMBERING" => "N",
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
	"PAGER_SHOW_ALL" => "N",
	"PAGER_SHOW_ALWAYS" => "N",
	"PAGER_TEMPLATE" => ".default",
	"PAGER_TITLE" => "Новости",
	"PARENT_SECTION" => "",
	"PARENT_SECTION_CODE" => "",
	"PREVIEW_TRUNCATE_LEN" => "",
	"PROPERTY_CODE" => [
		0 => "ALL_CITY",
		1 => "BOLD",
		2 => "DISPLAY_LIST",
		3 => "",
	],
	"SET_BROWSER_TITLE" => "N",
	"SET_LAST_MODIFIED" => "N",
	"SET_META_DESCRIPTION" => "N",
	"SET_META_KEYWORDS" => "N",
	"SET_STATUS_404" => "N",
	"SET_TITLE" => "N",
	"SHOW_404" => "N",
	"SORT_BY1" => "SORT",
	"SORT_BY2" => "NAME",
	"SORT_ORDER1" => "ASC",
	"SORT_ORDER2" => "ASC",
	"STRICT_SECTION_CHECK" => "N",
	"COMPONENT_TEMPLATE" => "city.list"
], false);
/*$getGeo = $APPLICATION->IncludeComponent("nfksber:location", "", array(
    'CACHE_TYPE' => 'Y',
    'ACTION_VARIABLE' => 'action',
));*/
?>
<? if (!$USER->IsAuthorized()) { ?>
    <noindex>
        <div id="regpopup_bg">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-sm-12 col-md-8 col-lg-6 col-xl-6">
                        <div class="regpopup_win">
                            <div id="regpopup_close">Х</div>
                            <div class="regpopup_content" id="regpopup_registration" style="display:none;">
                                <h2>Регистрация</h2>
								<?
								ShowMessage($arParams["~AUTH_RESULT"]);
								$APPLICATION->IncludeComponent("bitrix:main.register", "anypact", [
									"USER_PROPERTY_NAME" => "UF_IS_IN_PROMOTION",
									"SEF_MODE" => "N",
									"SHOW_FIELDS" => ["LOGIN", "EMAIL", "PASSWORD", "CONFIRM_PASSWORD", "PERSONAL_PHONE", 'UF_IS_IN_PROMOTION'],
									"REQUIRED_FIELDS" => [],
									"AUTH" => "Y",
									"USE_BACKURL" => "N",
									"SUCCESS_PAGE" => "/informaciya_o_registracii",//$APPLICATION->GetCurPageParam('',array('backurl')),
									"SET_TITLE" => "N",
									"USER_PROPERTY" => ["UF_IS_IN_PROMOTION"]
								]);
								?>
                            </div>
                            <div class="regpopup_autorisation" id="regpopup_autarisation">
                                <h2>Авторизация</h2>
								<?
								$APPLICATION->IncludeComponent("bitrix:system.auth.form", "new_anypact_auth_form", [
									"REGISTER_URL" => "register.php",
									"FORGOT_PASSWORD_URL" => "",
									"PROFILE_URL" => "profile.php",
									"SHOW_ERRORS" => "Y",
									"STORE_PASSWORD" => "Y"
								]);
								?>
                            </div>
                            <div class="regpopup_content" id="regpopup_forgotpassword" style="display:none;">
                                <h2>Восстановление пароля</h2>
								<?
								$APPLICATION->IncludeComponent("bitrix:system.auth.forgotpasswd", "anypact", [
									"REGISTER_URL" => "",
									"FORGOT_PASSWORD_URL" => "",
									"PROFILE_URL" => "/profile/",
									"SHOW_ERRORS" => "Y",
									"STORE_PASSWORD" => "Y"
								]);
								?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </noindex>
<? } else {
	$APPLICATION->IncludeComponent("nfksber:moneta.registration", "", [
		"ACTION_VARIABLE" => "action"
	]);
	$APPLICATION->IncludeComponent("nfksber:notification.list", "", [
		"ACTION_VARIABLE" => "action"
	]);
} ?>

<div class="container">

    <header class="header" id="header" style="width: 100%;">
        <div class="header_item tablet_ver_logo">
            <a href="/" class="logo">
                <img src="<?= SITE_TEMPLATE_PATH ?>/image/logo_ap.svg" alt="" style="width: 166px;">
            </a>
			<? if (!empty($getGeo['cityName'])): ?>
                <span class="location"><?= $getGeo['cityName'] ?></span>
			<? else: ?>
                <span class="location">Выберите город</span>
			<? endif ?>
            <a href="/AnyPact инструкция.pdf" class="manual" target="_blank"
               onclick="ym(64629523,'reachGoal','manual');">Инструкция</a>
        </div>
		<? if ($USER->IsAuthorized()) :
			$res = CUser::GetList($by = "personal_country", $order = "desc", ['ID' => $USER->GetID()], ['SELECT' => ['UF_ESIA_AUT'], 'FIELDS' => ['ID']]);
			if ($u = $res->getNext())
				$userEsiaAut = $u['UF_ESIA_AUT'];
			?>
            <div class="header_item tablet_ver_profile">
				<? if ($userEsiaAut != 1) : ?>
                    <div class="profile_item">
                        <div class="create-pact-btn">
                            <a href="/first-help/"></a>
                            <div>Помощь в создании объявления</div>
                        </div>
                    </div>
				<? else: ?>
					<? $APPLICATION->IncludeComponent("nfksber:moneta.balance", "", []); ?>
                    <div class="profile_item">
                        <div class="create-pact-btn">
                            <a href="/my_pacts/edit_my_pact/?ACTION=ADD"></a>
                            <div>Создать предложение</div>
                        </div>
                    </div>
				<? endif; ?>
                <div class="profile_item">
                    <a href="/search/" class="search-header-button">
                        <span class="icon"></span>
                        <span>поиск</span>
                    </a>
                </div>
                <div class="profile_item">
					<?
					$APPLICATION->IncludeComponent("nfksber:profile.widget", "head", [
						'IS_PAGE_MESSAGE' => $APPLICATION->GetCurPage() == '/list_message/view_message/' ? 'Y' : 'N'
					]);
					?>
                </div>
            </div>
		<? else : ?>
            <div class="header_item tablet_ver_tel_login tablet_ver_tel_login_custom">
                <div class="create-pact-btn">
                    <a href="/first-help/"></a>
                    <div>Помощь в создании объявления</div>
                </div>
                <div class="profile_item">
                    <a href="/search/" class="search-header-button">
                        <span class="icon"></span>
                        <span>поиск</span>
                    </a>
                </div>
                <button class="btn btn-nfk btn-login" id="reg_button"
                        onclick="ym(64629523,'reachGoal','reg_btn');">Регистрация / Вход
                </button>
            </div>
		<? endif; ?>
    </header>
    <nav class="navbar navbar-expand-md" style="width: 100%;">
        <div class="navbar-brand-block">
			<?
			$Section = $_GET['SECTION_ID'];
			$APPLICATION->IncludeComponent("nfksber:stepback", "", [
				"IBLOCK_ID" => "3",
				"SECTION_ID" => $Section,
			]);
			?>
        </div>
        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse"
                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
        </button>
        <a href="/" class="logo"><img src="/local/templates/anypact/image/logo_ap.svg" alt="" style="width: 150px;"></a>
        <div>
			<? if ($USER->IsAuthorized()) : ?>
				<?
				$APPLICATION->IncludeComponent("nfksber:profile.widget", "head", [
					'IS_PAGE_MESSAGE' => $APPLICATION->GetCurPage() == '/list_message/view_message/' ? 'Y' : 'N'
				]);
				?>
			<? else : ?>
                <div class="create-pact-btn desctop_btn">
                    <a href="/my_pacts/edit_my_pact/?ACTION=ADD"></a>
                    <div>Создать предложение</div>
                </div>
			<? endif ?>
        </div>
        <div class="collapse navbar-collapse " id="navbarSupportedContent" style="padding-right: 0;">
			<?
			/*/
		   // навигационное меню для разных типов пользователей
		   if ($USER->IsAuthorized()) {
			   // авторизованный пользователь
			   $arUrlMenu = array(
				   '/pacts/' => 'Все предложения',
				   '/search_people/' => 'Поиск контрагентов',
				   '/my_pacts/' => 'Мои сделки',
				   '/friends/' => 'Мои друзья',
				   '/list_message/' => 'Сообщения',
				   '/service/' => 'О сервисе',
				   '/help/' => 'Контакты'
			   );
			   if (COption::GetOptionInt("main", "promotion_on") != 0) {
				   $arUrlMenu['/promotion/'] = 'Промоакция';
			   }
			   if (COption::GetOptionInt("main", "promotion_2022_on") != 0) {
				   $arUrlMenu['/promotion-2022/'] = 'Промоакция';
			   }
		   } else {
			   // неавторизованный пользователь
			   $arUrlMenu = array(
				   '/pacts/' => 'Все предложения',
				   '/search_people/' => 'Поиск контрагентов',
				   '/service/' => 'О сервисе',
				   '/help/' => 'Контакты'
			   );
			   if (COption::GetOptionInt("main", "promotion_on") != 0) {
				   $arUrlMenu['/promotion/'] = 'Промоакция';
			   }
			   if (COption::GetOptionInt("main", "promotion_2022_on") != 0) {
				   $arUrlMenu['/promotion-2022/'] = 'Промоакция';
			   }
			   $arUrlMenu['#'] = 'Регистрация/вход';
		   }

		   $APPLICATION->IncludeComponent("nfksber:navmenu.head", "", [
			   "ArURL_MENU" => $arUrlMenu,
		   ]);
		   /**/
			$APPLICATION->IncludeComponent("bitrix:menu", "top.main", [
				"COMPONENT_TEMPLATE" => "top.main",
				"ROOT_MENU_TYPE" => "top",
				"MENU_CACHE_TYPE" => "A",
				"MENU_CACHE_TIME" => "3600",
				"MENU_CACHE_USE_GROUPS" => "Y",
				"MENU_CACHE_GET_VARS" => [],
				"MAX_LEVEL" => "1",
				"CHILD_MENU_TYPE" => "left",
				"USE_EXT" => "N",
				"DELAY" => "N",
				"ALLOW_MULTI_SELECT" => "N"
			], false);

			if ($USER->IsAuthorized()) {
				$APPLICATION->IncludeComponent("nfksber:messenger_hl.unread.wiget", "", ['ACTION_VARIABLE' => 'action']);
				$APPLICATION->IncludeComponent("nfksber:friends.incoming.wiget", "", ['ACTION_VARIABLE' => 'action']);
			}
			?>
        </div>
    </nav>