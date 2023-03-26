<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

CJSCore::Init();
$asset = \Bitrix\Main\Page\Asset::getInstance();
$asset->addCss(SITE_TEMPLATE_PATH . '/css/auth.css');
?>

<div class="container">
<div class="bx-system-auth-form auth-form__custom form_container">

<?php if ($arResult['SHOW_ERRORS'] === 'Y' && $arResult['ERROR']) ShowMessage($arResult['ERROR_MESSAGE']); ?>

<?php if($arResult["FORM_TYPE"] === "login"):?>
            <img src="<?= SITE_TEMPLATE_PATH ?>/img/Portal.svg" class="top_icon" alt="">
            <h1>Вход в систему</h1>
            <form name="system_auth_form<?=$arResult["RND"]?>" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
                <?php if($arResult["BACKURL"] <> ''):?>
                    <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
                <?php endif?>
                <?php foreach ($arResult["POST"] as $key => $value):?>
                    <input type="hidden" name="<?=$key?>" value="<?=$value?>" />
                <?php endforeach?>
                <input type="hidden" name="AUTH_FORM" value="Y" />
                <input type="hidden" name="TYPE" value="AUTH" />
                <div class="input_group">
                    <input type="text" class="login_input" placeholder="Логин" name="USER_LOGIN" maxlength="50">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/img/person.svg" alt="">
                </div>
                <div class="input_group">
                    <input type="password" class="pass_input" placeholder="Пароль" name="USER_PASSWORD" maxlength="255" autocomplete="off">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/img/visibility-off.svg" alt="" class="show_pass">
                </div>
                <p style="padding-top: 0">Действия</p>

                <?php if ($arResult["STORE_PASSWORD"] === "Y"):?>
                <div class="remember">
                    <input type="checkbox" id="USER_REMEMBER_frm" name="USER_REMEMBER" value="Y" />
                    <label for="USER_REMEMBER_frm" title="">Запомнить меня</label>
                </div>
                <?php endif?>
                <?php if ($arResult["CAPTCHA_CODE"]):?>
                    <?= GetMessage("AUTH_CAPTCHA_PROMT")?>:<br />
                    <input type="hidden" name="captcha_sid" value="<?= $arResult["CAPTCHA_CODE"]?>" />
                    <img src="/bitrix/tools/captcha.php?captcha_sid=<?= $arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" /><br /><br />
                    <input type="text" name="captcha_word" maxlength="50" value="" />
                <?php endif?>

                <input class="btn submit-btn" type="submit" name="Login" value="Войти" />
                <a href="/register/" class="register_btn">Регистрация</a>
        </form>
    <?php else:?>
    <?php global $USER; ?>
        <form action="<?=$arResult["AUTH_URL"]?>">
            <img src="<?= $USER->GetParam("PERSONAL_PHOTO") ?
                CFile::GetPath($USER->GetParam("PERSONAL_PHOTO")) :
                SITE_TEMPLATE_PATH . '/img/Portal.svg' ?>" class="top_icon" alt="" style="border-radius: 50%">
            <h1>Вы зашли как:</h1>
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
            <input class="btn submit-btn" type="submit" name="logout_butt" value="<?=GetMessage("AUTH_LOGOUT_BUTTON")?>" />
        </form>
    <?php endif?>
    <script>
        const showPass = document.querySelector('.show_pass');
        if(showPass) {
            showPass.addEventListener('click', (e) => {
                e.preventDefault();
                const parent = e.target.parentNode.querySelector('.pass_input');
                if (parent.getAttribute('type') === 'password') {
                    parent.setAttribute('type', 'text');
                } else {
                    parent.setAttribute('type', 'password');
                }
            });
        }
    </script>
</div>
</div>