<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
global $APPLICATION, $USER;
$APPLICATION->SetPageProperty('title', 'Timwork - список заявок');
if (!$USER->IsAuthorized()) {
    LocalRedirect('/user/', false, '301 Moved Permanently');
}
?>
<?php
$APPLICATION->IncludeComponent(
    'custom:task.list',
    'admin',
    [
        'ADMIN' => 'Y'
    ]
);
?>


<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>

