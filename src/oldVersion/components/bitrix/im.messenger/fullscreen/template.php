<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

?>
<?/**/?>
<div class="bx-desktop-placeholder" id="workarea-content"></div>
<script type="text/javascript">


	document.title = '<?=GetMessage('IM_FULLSCREEN_TITLE_2')?>';
	<?=CIMMessenger::GetTemplateJS(Array(), $arResult)?>
</script>
<?/*/?>
<?php

function GetTemplateJS($arParams, $arTemplate)
{
	global $USER;

	$ppStatus = 'false';
	$ppServerStatus = 'false';
	$updateStateInterval = 'auto';
	if (CModule::IncludeModule("pull"))
	{
		$ppStatus = CPullOptions::ModuleEnable()? 'true': 'false';
		$ppServerStatus = CPullOptions::GetNginxStatus()? 'true': 'false';

		$updateStateInterval = CPullOptions::GetNginxStatus()? self::GetSessionLifeTime(): 80;
		if ($updateStateInterval > 100)
		{
			if ($updateStateInterval > 3600)
				$updateStateInterval = 3600;

			if (in_array($arTemplate["CONTEXT"], Array("POPUP-FULLSCREEN", "MESSENGER")))
				$updateStateInterval = $updateStateInterval-60;
			else
				$updateStateInterval = intval($updateStateInterval/2)-10;
		}
	}

	$diskStatus = CIMDisk::Enabled();
	$diskExternalLinkStatus = CIMDisk::EnabledExternalLink();

	$phoneCanPerformCalls = false;
	$phoneDeviceActive = false;
	$phoneCanCallUserNumber = false;
	$phoneEnabled = false;
	$chatExtendShowHistory = \COption::GetOptionInt('im', 'chat_extend_show_history');
	$contactListLoad = \COption::GetOptionInt('im', 'contact_list_load');
	$contactListBirthday = \COption::GetOptionString('im', 'contact_list_birthday');
	$isFullTextEnabled = \Bitrix\Im\Model\MessageIndexTable::getEntity()->fullTextIndexEnabled("SEARCH_CONTENT");
	$fullTextMinSizeToken = \Bitrix\Main\ORM\Query\Filter\Helper::getMinTokenSize();
	$phoneCanInterceptCall = self::CanInterceptCall();

	if ($arTemplate['INIT'] == 'Y')
	{
		$phoneEnabled = self::CheckPhoneStatus();
		if ($phoneEnabled && CModule::IncludeModule('voximplant'))
		{
			$phoneCanPerformCalls = self::CanUserPerformCalls();
			$phoneDeviceActive = CVoxImplantUser::GetPhoneActive($USER->GetId());
			$phoneCanCallUserNumber = self::CanUserCallUserNumber();
		}
	}

	$counters = \Bitrix\Im\Counter::get(null, ['JSON' => 'Y']);
	$counters['type']['mail'] = (int)$arResult["MAIL_COUNTER"];

	$crmPath = Array();
	$olConfig = Array();
	$businessUsers = false;

	if (\Bitrix\Main\Loader::includeModule('crm'))
	{
		$crmPath['LEAD'] = \Bitrix\Im\Integration\Crm\Common::getLink('LEAD');
		$crmPath['CONTACT'] = \Bitrix\Im\Integration\Crm\Common::getLink('CONTACT');
		$crmPath['COMPANY'] = \Bitrix\Im\Integration\Crm\Common::getLink('COMPANY');
		$crmPath['DEAL'] = \Bitrix\Im\Integration\Crm\Common::getLink('DEAL');
	}

	if (\Bitrix\Main\Loader::includeModule('imopenlines'))
	{
		$olConfig['canDeleteMessage'] = str_replace('.', '_', \Bitrix\Imopenlines\Connector::getListCanDeleteMessage());
		$olConfig['canDeleteOwnMessage'] = str_replace('.', '_', \Bitrix\Imopenlines\Connector::getListCanDeleteOwnMessage());
		$olConfig['canUpdateOwnMessage'] = str_replace('.', '_', \Bitrix\Imopenlines\Connector::getListCanUpdateOwnMessage());

		$olConfig['queue'] = Array();
		foreach (\Bitrix\ImOpenLines\Config::getQueueList($USER->GetID()) as $config)
		{
			$olConfig['queue'][] = array_change_key_case($config, CASE_LOWER);
		}

		$olConfig['canUseVoteHead'] = Imopenlines\Limit::canUseVoteHead();
		$olConfig['canJoinChatUser'] = Imopenlines\Limit::canJoinChatUser();
		$olConfig['canTransferToLine'] = Imopenlines\Limit::canTransferToLine();
	}

	$bitrix24blocked = false;
	$bitrix24Enabled = false;
	$bitrixPaid = true;
	if (\Bitrix\Main\Loader::includeModule('bitrix24'))
	{
		$bitrix24Enabled = true;
		$bitrixPaid = CBitrix24::IsLicensePaid();
		if (CIMMessenger::IsBitrix24UserRestricted())
		{
			$bitrix24blocked = \Bitrix\Bitrix24\Limits\User::getUserRestrictedHelperCode();
		}
	}

	$userBirthday = \Bitrix\Im\Integration\Intranet\User::getBirthdayForToday();

	$pathToIm = isset($arTemplate['PATH_TO_IM']) ? $arTemplate['PATH_TO_IM'] : '';
	$pathToCall = isset($arTemplate['PATH_TO_CALL']) ? $arTemplate['PATH_TO_CALL'] : '';
	$pathToFile = isset($arTemplate['PATH_TO_FILE']) ? $arTemplate['PATH_TO_FILE'] : '';
	$pathToLf = isset($arTemplate['PATH_TO_LF']) ? $arTemplate['PATH_TO_LF'] : '/';
	$pathToDisk = Array(
		'localFile' => \CIMDisk::GetLocalDiskFilePath(),
	);

	$userColor = isset($arTemplate['CONTACT_LIST']['users'][$USER->GetID()]['color']) ? $arTemplate['CONTACT_LIST']['users'][$USER->GetID()]['color']: '';

	$isOperator = Imopenlines\User::isOperator();

	$recentLastUpdate = (new \Bitrix\Main\Type\DateTime())->format(\DateTimeInterface::RFC3339);
	$recent = \Bitrix\Im\Recent::getList(null, [
		'SKIP_NOTIFICATION' => 'Y',
		'SKIP_OPENLINES' => ($isOperator? 'Y': 'N'),
		'JSON' => 'Y'
	]);

	$sJS = "
			BX.ready(function() {
				BXIM = new BX.IM(BX('bx-notifier-panel'), {
					'init': ".($arTemplate['INIT'] == 'Y'? 'true': 'false').",
					'context': '".$arTemplate["CONTEXT"]."',
					'design': '".$arTemplate["DESIGN"]."',
					'colors': ".(\Bitrix\Im\Color::isEnabled()? \Bitrix\Im\Common::objectEncode(\Bitrix\Im\Color::getSafeColorNames()): 'false').",
					'colorsHex': ".\Bitrix\Im\Common::objectEncode(\Bitrix\Im\Color::getSafeColors()).",
					'chatCounters': ".\Bitrix\Im\Common::objectEncode($counters, true).",
					'counters': ".(empty($arTemplate['COUNTERS'])? '{}': \Bitrix\Im\Common::objectEncode($arTemplate['COUNTERS'])).",
					'ppStatus': ".$ppStatus.",
					'ppServerStatus': ".$ppServerStatus.",
					'updateStateInterval': '".$updateStateInterval."',
					'openChatEnable': ".(CIMMessenger::CheckEnableOpenChat()? 'true': 'false').",
					'xmppStatus': ".(CIMMessenger::CheckXmppStatusOnline()? 'true': 'false').",
					'isAdmin': ".(self::IsAdmin()? 'true': 'false').",
					'canInvite': ".(\Bitrix\Im\Integration\Intranet\User::canInvite()? 'true': 'false').",
					'isLinesOperator': ".($isOperator? 'true': 'false').",
					'isUtfMode': ".(\Bitrix\Main\Application::getInstance()->isUtfMode()? 'true': 'false').",
					'bitrixNetwork': ".(CIMMessenger::CheckNetwork()? 'true': 'false').",
					'bitrix24': ".($bitrix24Enabled? 'true': 'false').",
					'bitrix24blocked': ".($bitrix24blocked? $bitrix24blocked: 'false').",
					'bitrix24net': ".(IsModuleInstalled('b24network')? 'true': 'false').",
					'bitrixPaid': ".($bitrixPaid? 'true': 'false').",
					'bitrixIntranet': ".(IsModuleInstalled('intranet')? 'true': 'false').",
					'bitrixXmpp': ".(IsModuleInstalled('xmpp')? 'true': 'false').",
					'bitrixMobile': ".(IsModuleInstalled('mobile')? 'true': 'false').",
					'bitrixOpenLines': ".(IsModuleInstalled('imopenlines')? 'true': 'false').",
					'bitrixCrm': ".(IsModuleInstalled('crm')? 'true': 'false').",
					'desktop': ".$arTemplate["DESKTOP"].",
					'desktopStatus': ".(CIMMessenger::CheckDesktopStatusOnline()? 'true': 'false').",
					'desktopVersion': ".CIMMessenger::GetDesktopVersion().",
					'desktopLinkOpen': ".$arTemplate["DESKTOP_LINK_OPEN"].",
					'language': '".LANGUAGE_ID."',
					'loggerConfig': ".\Bitrix\Im\Common::objectEncode(\Bitrix\Im\Settings::getLoggerConfig(), true).",
					'broadcastingEnabled': ".\Bitrix\Im\Common::objectEncode(\Bitrix\Im\Settings::isBroadcastingEnabled(), true).",
					'tooltipShowed': ".\Bitrix\Im\Common::objectEncode(CUserOptions::GetOption('im', 'tooltipShowed', array())).",
					'limit': ".(empty($arTemplate['LIMIT'])? 'false': \Bitrix\Im\Common::objectEncode($arTemplate["LIMIT"])).",
					'promo': ".(empty($arTemplate['PROMO'])? '[]': \Bitrix\Im\Common::objectEncode($arTemplate["PROMO"])).",
					'bot': ".(empty($arTemplate['BOT'])? '{}': \Bitrix\Im\Common::objectEncode($arTemplate["BOT"])).",
					'textareaIcon': ".(empty($arTemplate['TEXTAREA_ICON'])? '{}': \Bitrix\Im\Common::objectEncode($arTemplate["TEXTAREA_ICON"])).",
					'command': ".(empty($arTemplate['COMMAND'])? '[]': \Bitrix\Im\Common::objectEncode($arTemplate["COMMAND"])).",

					'smile': ".\Bitrix\Im\Common::objectEncode($arTemplate["SMILE"]).",
					'smileSet': ".\Bitrix\Im\Common::objectEncode($arTemplate["SMILE_SET"]).",
					'settings': ".\Bitrix\Im\Common::objectEncode($arTemplate['SETTINGS']).",
					'settingsNotifyBlocked': ".(empty($arTemplate['SETTINGS_NOTIFY_BLOCKED'])? '{}': \Bitrix\Im\Common::objectEncode($arTemplate['SETTINGS_NOTIFY_BLOCKED'])).",

					'recent': ".\Bitrix\Im\Common::objectEncode($recent, true).",
					'recentLastUpdate': '".$recentLastUpdate."',
					'businessUsers': ".($businessUsers === false? 'false': (empty($businessUsers)? '{}': \Bitrix\Im\Common::objectEncode($businessUsers))).",
					'userChatOptions': ".\Bitrix\Im\Common::objectEncode(CIMChat::GetChatOptions()).",
					'historyOptions' : ".\Bitrix\Im\Common::objectEncode(['fullTextEnabled' => $isFullTextEnabled, 'ftMinSizeToken' => $fullTextMinSizeToken]).",
					'openMessenger' : ".(isset($_REQUEST['IM_DIALOG'])? "'".CUtil::JSEscape(htmlspecialcharsbx($_REQUEST['IM_DIALOG']))."'": 'false').",
					'openHistory' : ".(isset($_REQUEST['IM_HISTORY'])? "'".CUtil::JSEscape(htmlspecialcharsbx($_REQUEST['IM_HISTORY']))."'": 'false').",
					'openNotify' : ".(isset($_GET['IM_NOTIFY']) && $_GET['IM_NOTIFY'] == 'Y'? 'true': 'false').",
					'openSettings' : ".(isset($_GET['IM_SETTINGS'])? $_GET['IM_SETTINGS'] == 'Y'? "'true'": "'".CUtil::JSEscape(htmlspecialcharsbx($_GET['IM_SETTINGS']))."'": 'false').",
					'externalRecentList' : '".(isset($arTemplate['EXTERNAL_RECENT_LIST'])?$arTemplate['EXTERNAL_RECENT_LIST']: '')."',

					'generalChatId': ".CIMChat::GetGeneralChatId().",
					'canSendMessageGeneralChat': ".(CIMChat::CanSendMessageToGeneralChat($USER->GetID())? 'true': 'false').",
					'debug': ".(defined('IM_DEBUG')? 'true': 'false').",
					'next': ".(defined('IM_NEXT')? 'true': 'false').",
					'userId': ".$USER->GetID().",
					'userEmail': '".CUtil::JSEscape($USER->GetEmail())."',
					'userColor': '".\Bitrix\Im\Color::getCode($userColor)."',
					'userGender': '".\Bitrix\Im\User::getInstance()->getGender()."',
					'userExtranet': ".(\Bitrix\Im\User::getInstance()->isExtranet()? 'true': 'false').",
					'user': ".($arTemplate['CURRENT_USER']? \Bitrix\Im\Common::objectEncode($arTemplate['CURRENT_USER']): '{}').",
					'userBirthday': ".(!empty($userBirthday)? \Bitrix\Im\Common::objectEncode($userBirthday): '[]').",
					'webrtc': {
						'turnServer' : '".CUtil::JSEscape($arTemplate['TURN_SERVER'])."',
						'turnServerFirefox' : '".CUtil::JSEscape($arTemplate['TURN_SERVER_FIREFOX'])."',
						'turnServerLogin' : '".CUtil::JSEscape($arTemplate['TURN_SERVER_LOGIN'])."',
						'turnServerPassword' : '".CUtil::JSEscape($arTemplate['TURN_SERVER_PASSWORD'])."',
						'mobileSupport': false,
						'phoneEnabled': ".($phoneEnabled? 'true': 'false').",
						'phoneDeviceActive': '".($phoneDeviceActive? 'Y': 'N')."',
						'phoneCanPerformCalls': '".($phoneCanPerformCalls? 'Y': 'N')."',
						'phoneCanCallUserNumber': '".($phoneCanCallUserNumber? 'Y': 'N')."',
						'phoneCanInterceptCall': ".($phoneCanInterceptCall? 'true': 'false').",
						'phoneCallCardRestApps': ".\Bitrix\Im\Common::objectEncode(self::GetCallCardRestApps()).",
						'phoneDefaultLineId': '".self::GetDefaultTelephonyLine()."',
						'availableLines': ".\Bitrix\Im\Common::objectEncode(self::GetTelephonyAvailableLines()).",
						'formatRecordDate': '".\Bitrix\Main\Context::getCurrent()->getCulture()->getShortDateFormat()."'
					},
					'openlines': ".\Bitrix\Im\Common::objectEncode($olConfig).",
					'options': {'contactListLoad' : ".($contactListLoad? 'true': 'false').", 'contactListBirthday' : '".$contactListBirthday."', 'chatExtendShowHistory' : ".($chatExtendShowHistory? 'true': 'false').", 'frameMode': ".($_REQUEST['IFRAME'] == 'Y'? 'true': 'false').", 'frameType': '".($_REQUEST['IFRAME_TYPE'] == 'SIDE_SLIDER'? 'SIDE_SLIDER': 'NONE')."', 'showRecent': ".($_REQUEST['IM_RECENT'] == 'N'? 'false': 'true').", 'showMenu': ".($_REQUEST['IM_MENU'] == 'N'? 'false': 'true')."},
					'disk': {'enable' : ".($diskStatus? 'true': 'false').", 'external' : ".($diskExternalLinkStatus? 'true': 'false')."},
					'zoomStatus': {'active' : ".(\Bitrix\Im\Call\Integration\Zoom::isActive()? 'true': 'false').", 'enabled' : ".(\Bitrix\Im\Call\Integration\Zoom::isAvailable()? 'true': 'false').", 'connected' : ".(\Bitrix\Im\Call\Integration\Zoom::isConnected($USER->GetID())? 'true': 'false')."},
					'path' : {'lf' : '".CUtil::JSEscape($pathToLf)."', 'profile' : '".CUtil::JSEscape($arTemplate['PATH_TO_USER_PROFILE'])."', 'profileTemplate' : '".CUtil::JSEscape($arTemplate['PATH_TO_USER_PROFILE_TEMPLATE'])."', 'mail' : '".CUtil::JSEscape($arTemplate['PATH_TO_USER_MAIL'])."', 'im': '".CUtil::JSEscape($pathToIm)."', 'call': '".CUtil::JSEscape($pathToCall)."', 'file': '".CUtil::JSEscape($pathToFile)."', 'crm' : ".\Bitrix\Im\Common::objectEncode($crmPath).", 'disk' : ".\Bitrix\Im\Common::objectEncode($pathToDisk)."}
				});
			});
		";

	return $sJS;
}

?>
<div class="bx-desktop-placeholder" id="workarea-content"></div>
<script type="text/javascript">
	document.title = '<?=GetMessage('IM_FULLSCREEN_TITLE_2')?>';
	<?=GetTemplateJS(Array(), $arResult)?>
</script>
<?/**/?>