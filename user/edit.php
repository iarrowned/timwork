<?php

use Bitrix\Main\Context;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

global $APPLICATION;
$APPLICATION->SetTitle("Новый раздел");
global $USER;

if (!$USER->IsAuthorized()) {
    LocalRedirect('/user/', false, '301 Moved Permanently');
}

$request = Context::getCurrent()->getRequest();
$tastId = $request->get('id');
if (!$tastId) {
    die("Invalid id");
}
?>

<?php
$APPLICATION->IncludeComponent(
    'custom:form.edit',
    '',
    [
        'TASK_ID' => $tastId,
    ]
);
?>

<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>