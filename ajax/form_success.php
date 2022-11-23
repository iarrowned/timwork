<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';

$request = \Bitrix\Main\Context::getCurrent()->getRequest();
$response = new \Bitrix\Main\Engine\Response\Json([
    'ok' => true,
    'result_id' => $request->get('RESULT_ID')
]);
$response->send();
die();