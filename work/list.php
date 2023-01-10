<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
global $APPLICATION;
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

