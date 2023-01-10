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
$taskId = $request->get('id');
if (!$taskId) {
    die("Invalid id");
}
?>

<?php
$APPLICATION->IncludeComponent(
    'custom:form',
    '',
    [
        'TASK_ID' => $taskId,
    ]
);
?>

<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>