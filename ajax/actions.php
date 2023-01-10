<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
require($_SERVER["DOCUMENT_ROOT"]."/src/Tools/HighloadTool.php");
use Bitrix\Main\Context;
use Tools\HighloadTool;

$request = Context::getCurrent()->getRequest();

$action = $request->getPost('action');

if ($action === 'update') {
    $entity = HighloadTool::getTaskEntity();
    $taskId = $request->getPost('task_id');
    $result = $entity::update($taskId, [
        'UF_WORKER_ID' => $request->getPost('worker_id'),
        'UF_STATUS' => $request->getPost('status_id'),
    ]);
    die(json_encode($result));
}


?>