<?php

use Bitrix\Main\Application;
use Tools\HighloadTool;

require_once $_SERVER['DOCUMENT_ROOT'] . '/src/Tools/HighloadTool.php';

/**
 * Class TaskListComponent
 */
class TaskListComponent extends \CBitrixComponent
{
    private $entity;
    private $userId;
    private $taskList;

    public function onPrepareComponentParams($arParams)
    {
        return parent::onPrepareComponentParams($arParams);
    }

    public function executeComponent()
    {
        global $APPLICATION;
        global $USER;

        $this->entity = HighloadTool::getTaskEntity();
        $this->userId = $USER->GetID();

        $this->taskList = $this->entity::getList([
            "select" => array("*"),
            "order" => array("ID" => "ASC"),
            "filter" => array('UF_USER_ID' => $this->userId)
        ])->fetchAll();


        $this->arResult['TASKS'] = $this->taskList;

        $this->includeComponentTemplate();
    }

}
