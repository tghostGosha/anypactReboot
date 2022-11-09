<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
CJSCore::Init();
?>
<div class="regpopup_content_auform">
	<form name="bform" id="form_forgotpwd" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
		<p class="regpopup_content_text">На указанную вами при регистрации почту будет отправлена ссылка на восстановление пароля</p>
		<? if (strlen($arResult["BACKURL"]) > 0) {?>
			<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
		<?} ?>

		<? if ( is_array( $arResult["POST"] ) ) {
			foreach ($arResult["POST"] as $key => $value):?>
            <input type="hidden" name="<?=$key?>" value="<?=$value?>" />
			<?endforeach;
		}?>
		<input type="hidden" name="AUTH_FORM" value="Y">
		<input type="hidden" name="TYPE" value="SEND_PWD">
		<?/*/?>
		<input type="text" name="USER_EMAIL" id="user_email_fgpw" value="<?=$arResult["LAST_EMAIL"]?>" placeholder="<?=GetMessage("sys_forgot_pass_email")?>"/>
        <?/**/?>
		<input type="text" name="USER_LOGIN" id="user_email_fgpw" value="<?=$arResult["LAST_EMAIL"]?>" placeholder="<?=GetMessage("sys_forgot_pass_email")?>"/>
        <input type="hidden" name="USER_EMAIL" />

		<?if($arResult["USE_CAPTCHA"]):?>
			<div style="margin-top: 16px">
				<div>
					<input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
					<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
				</div>
				<div><?echo GetMessage("system_auth_captcha")?></div>
				<div><input type="text" name="captcha_word" maxlength="50" value="" /></div>
			</div>
		<?endif?>
		<div id="message_error_forget_pass"></div>
		<a href="#" class="regpopup_content_form_submit" id="submit_forgot_password"><?=GetMessage("AUTH_SEND")?></a>
	</form>
</div>
<?
	$open_popup = '?open_fgp_popup=Y';
	if(!empty($_GET))
		$open_popup = '&open_fgp_popup=Y';
	$encodeURL = base64_encode($_SERVER['REQUEST_URI'].$open_popup);
?>
<?if(COption::GetOptionString("anypact", "block_gosuslugi", "Y") != "Y"){?>
	<p class="text-center"><a href="/profile/aut_esia.php?returnurl=<?=$encodeURL?>">Не помню e-mail</a></p>
<?}?>
<p class="text-center">Вспомнили пароль? <a href="#" id="regpopup_btn_aut_fgpw">Войти</a></p>
<script>
	document.bform.onsubmit = function(){document.bform.USER_EMAIL.value = document.bform.USER_LOGIN.value;};
	document.bform.USER_LOGIN.focus();
	//воссстановлене пароля
	$(document).on('click', '#submit_forgot_password', function(){
		let formData = $('#form_forgotpwd').serialize();
		$.ajax({
			url: '?forgot_password=yes',
			data: formData,
			type: 'POST',
			success: function(data, textStatus, jqXHR ) {
				if(textStatus == 'success'){
					$('#form_forgotpwd').html('<div style="margin-bottom: 30px;">Инструкция по восстановлению пароля была отправлена вам на почту</div>');
				}
			},
			error: function(jqXHR, textStatus, errorThrown){
				console.log(jqXHR);
				console.log(textStatus);
				console.log(errorThrown);
			}
		});
		
    });
</script>