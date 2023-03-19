<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
global $APPLICATION, $USER;
$APPLICATION->SetPageProperty('title', 'Timwork - статистика');
if (!$USER->IsAuthorized()) {
    LocalRedirect('/user/', false, '301 Moved Permanently');
}
?>
<?php $APPLICATION->IncludeComponent(
    'custom:statistic',
    '',
    []
);
?>

<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
