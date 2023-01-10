<?php

use Bitrix\Main\Application;
use Bitrix\Main\Context;
use Tools\HighloadTool;

require_once $_SERVER['DOCUMENT_ROOT'] . '/src/Tools/HighloadTool.php';

/**
 * Class TaskListComponent
 */
class TaskDetailComponent extends \CBitrixComponent
{
    private $entity;
    protected $request;
    private $task;

    public function onPrepareComponentParams($arParams)
    {
        return parent::onPrepareComponentParams($arParams);
    }

    public function executeComponent()
    {

        global $USER;
        $this->request = Context::getCurrent()->getRequest();
        $taskId = $this->request->get('id');

        if (!$taskId) {
            $this->arResult["EMPTY"] = "Task not found";
        }

        $this->entity = HighloadTool::getTaskEntity();

        $this->task = $this->entity::getList([
            "select" => array("*"),
            "order" => array("ID" => "ASC"),
            "filter" => array('ID' => $taskId, 'UF_USER_ID' => $USER->GetID())
        ])->fetch();


        $this->arResult = $this->task;
        $this->arResult['DEPART_NAME'] = HighloadTool::getDepartById($this->arResult['UF_DEPART'])['UF_NAME'];

        $this->includeComponentTemplate();
    }

}
