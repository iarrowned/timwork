<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
require($_SERVER["DOCUMENT_ROOT"]."/src/Tools/HighloadTool.php");
require($_SERVER["DOCUMENT_ROOT"]."/src/Models/Task.php");
require($_SERVER["DOCUMENT_ROOT"]."/src/Models/Register.php");
use Bitrix\Main\Context;
use Tools\HighloadTool;
use Tools\Register;
use Tools\Task;

$request = Context::getCurrent()->getRequest();

$action = $request->getPost('action');

if ($action === 'update') {
    $entity = HighloadTool::getTaskEntity();
    $taskId = $request->getPost('task_id');
    if ($request->getPost('status_id') == 3) {
        return json_encode(Task::closeTask($taskId));
    }
    $result = $entity::update($taskId, [
        'UF_WORKER_ID' => $request->getPost('worker_id'),
        'UF_STATUS' => $request->getPost('status_id'),
        'UF_CLOSE_TIME' => null
    ]);
    die(json_encode($result));
}

if ($action === 'new') {
    $fields = $request->getPostList()->toArray()['FORM'];
    $task = new Task($fields);
    $result = $task->save();

    die(json_encode($result));
}

if ($action === 'register') {
    $fields = $request->getPostList()->toArray();
    $reg = new Register($fields);
    $result = $reg->save();
    die(json_encode($result));
}


?>