<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

CJSCore::Init();
$asset = \Bitrix\Main\Page\Asset::getInstance();
$asset->addCss(SITE_TEMPLATE_PATH . '/css/auth.css');
?>

<div class="container">
<div class="bx-system-auth-form auth-form__custom">

<?php
if ($arResult['SHOW_ERRORS'] == 'Y' && $arResult['ERROR'])
	ShowMessage($arResult['ERROR_MESSAGE']);
?>

<?php if($arResult["FORM_TYPE"] == "login"):?>
            <h1 style="margin-bottom: 50px">Авторизация</h1>
            <form class="login-form" name="system_auth_form<?=$arResult["RND"]?>" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
                <?php if($arResult["BACKURL"] <> ''):?>
                    <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
                <?php endif?>
                <?php foreach ($arResult["POST"] as $key => $value):?>
                    <input type="hidden" name="<?=$key?>" value="<?=$value?>" />
                <?php endforeach?>
                <input type="hidden" name="AUTH_FORM" value="Y" />
                <input type="hidden" name="TYPE" value="AUTH" />
                <input type="text" placeholder="<?=GetMessage("AUTH_LOGIN")?>" name="USER_LOGIN" maxlength="50" value="" size="17" />
                <input type="password" placeholder="<?=GetMessage("AUTH_PASSWORD")?>" name="USER_PASSWORD" maxlength="255" size="17" autocomplete="off" />
                <div class="auth-block">
                    <?php if ($arResult["STORE_PASSWORD"] == "Y"):?>
                        <div class="remember">
                            <input type="checkbox" id="USER_REMEMBER_frm" name="USER_REMEMBER" value="Y" />
                            <label for="USER_REMEMBER_frm" title="<?=GetMessage("AUTH_REMEMBER_ME")?>"><?= GetMessage("AUTH_REMEMBER_SHORT")?></label>
                        </div>
                    <?php endif?>
                    <?php if ($arResult["CAPTCHA_CODE"]):?>
                        <?= GetMessage("AUTH_CAPTCHA_PROMT")?>:<br />
                        <input type="hidden" name="captcha_sid" value="<?= $arResult["CAPTCHA_CODE"]?>" />
                        <img src="/bitrix/tools/captcha.php?captcha_sid=<?= $arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" /><br /><br />
                        <input type="text" name="captcha_word" maxlength="50" value="" />
                    <?php endif?>
                    <?php if($arResult["NEW_USER_REGISTRATION"] == "Y"):?>
                        <noindex><a href="<?=$arResult["AUTH_REGISTER_URL"]?>" rel="nofollow"><?=GetMessage("AUTH_REGISTER")?></a></noindex><br />
                    <?php endif?>
                    <noindex><a href="<?=$arResult["AUTH_FORGOT_PASSWORD_URL"]?>" rel="nofollow"><?=GetMessage("AUTH_FORGOT_PASSWORD_2")?></a></noindex>
                </div>
                <input class="btn submit-btn" type="submit" name="Login" value="<?=GetMessage("AUTH_LOGIN_BUTTON")?>" />
                <a href="/register/">Регистрация</a>
        </form>
    <?php else:?>
        <form action="<?=$arResult["AUTH_URL"]?>" class="logout-form">
            <h2>Вы зашли как:</h2>
            <div class="form-name__block">
                <div class="form-name"><?=$arResult["USER_NAME"]?></div>
                <div class="form-name"><?=$arResult["USER_LOGIN"]?></div>
            </div>

            <br />
            <?php foreach ($arResult["GET"] as $key => $value):?>
                <input type="hidden" name="<?=$key?>" value="<?=$value?>" />
            <?php endforeach?>
            <?=bitrix_sessid_post()?>
            <input type="hidden" name="logout" value="yes" />
            <div class="btn-block">
                <input type="submit" class="btn logout-btn" name="logout_butt" value="<?=GetMessage("AUTH_LOGOUT_BUTTON")?>" />
            </div>
        </form>
    <?php endif?>

</div>
</div>