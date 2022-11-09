<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true);
global $USER, $APPLICATION;

if(THIS_PAGE != '/messenger/'):?>
<footer class="footer">
	<div class="container-fluid">
		<div class="margin-bottom25px">
			<img src="<?= SITE_TEMPLATE_PATH . '/image/logo_ap.svg' ?>" style="width: 166px;" alt="Anypact">
		</div>
		<div class="margin-bottom25px">
			<?$APPLICATION->IncludeFile("/include/soc_link_footer.php", [], ["MODE" => "html"]);?>
		</div>
		<div>
			&copy; <?= date('Y'); ?>
            <?$APPLICATION->IncludeFile("/include/footer/copyright.php", [], ["MODE" => "html"]);?>
		</div>
	</div>
	<a href="#panel" class="up-arrow"></a>
</footer>
<?endif;

require_once($_SERVER['DOCUMENT_ROOT'] . "/local/include/form_modal.php");

if (!$USER->IsAuthorized()) {
	if ($_COOKIE['PROMOTION_POPUP'] == "Y" || $_SESSION['PROMOTION_POPUP'] == "Y" || (empty($_COOKIE['PROMOTION_POPUP']) && empty($_SESSION['PROMOTION_POPUP'])) || ($_COOKIE['PROMOTION_POPUP'] < date('Ymd') && $_SESSION['PROMOTION_POPUP'] < date('Ymd'))) {
		if (COption::GetOptionInt("main", "promotion_on") != 0) {
			require_once($_SERVER['DOCUMENT_ROOT'] . "/local/include/promotion_popup.php");
		}
	}
	$APPLICATION->IncludeFile("/local/include/gosuslugi_check.php", [], ["MODE" => "html"]);
	//require_once($_SERVER['DOCUMENT_ROOT'] . "/local/include/gosuslugi_check.php");
}

$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/include/svg_icon.php", [], ["MODE" => "html"]);
$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/include/modal_forms.php", [], ["MODE" => "html"]);
?>


<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

<script type="text/javascript" src="<?= SITE_TEMPLATE_PATH ?>/js/js.js"></script>
<script src="<?= SITE_TEMPLATE_PATH . '/js/popup_script.js?1531732896309915' ?>"></script>
<? if ($USER->IsAuthorized()) : ?>
	<script src="<?= SITE_TEMPLATE_PATH . '/js/update_unread.js' ?>"></script>
<? endif ?>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WWQFXKG" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
</body>

</html>