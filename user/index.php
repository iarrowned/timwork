<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
global $APPLICATION;
?>

<?php
$APPLICATION->IncludeComponent("bitrix:system.auth.form", "custom_auth", Array(
	"REGISTER_URL" => "register.php",	// Страница регистрации
		"FORGOT_PASSWORD_URL" => "",	// Страница забытого пароля
		"PROFILE_URL" => "profile.php",	// Страница профиля
		"SHOW_ERRORS" => "Y",	// Показывать ошибки
	),
	false
);
?>

<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>
