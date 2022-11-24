<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/Tools/FormTool.php';

use Bitrix\Main\Context;
use Tools\FormTool;

$request = Context::getCurrent()->getRequest();

$action = $request->get('action');

switch ($action) {
    case 'update_result':
        FormTool::updateFormResult($request);
        break;
}
