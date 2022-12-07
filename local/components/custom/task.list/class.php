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
    private $statuses;

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

        $this->statuses = HighloadTool::getStatuses();
        foreach ($this->taskList as &$task) {
            if ($task['UF_STATUS']) {
                $statusName = HighloadTool::getStatusById($task['UF_STATUS']);
                $departName = HighloadTool::getDepartById($task['UF_DEPART']);
                $task['STATUS_NAME'] = $statusName['UF_STATUS'];
                $task['DEPART_NAME'] = $departName['UF_DEPART_NAME'];
            }
        }
        unset($task);


        $this->arResult['TASKS'] = $this->taskList;
        $this->arResult['STATUSES'] = $this->statuses;

        $this->includeComponentTemplate();
    }

}
