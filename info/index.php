<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
global $APPLICATION;
?>

<?php $APPLICATION->IncludeComponent(
    'custom:statistic',
    '',
    []
);
