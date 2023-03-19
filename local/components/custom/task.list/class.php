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
        $filter = [];

        if ($this->arParams['ADMIN'] !== 'Y') {
            $filter = ['UF_USER_ID' => $this->userId];
        } else {
            $this->arResult['ADMINS'] = $this->getAdmins();
            $this->arResult['STATUSES'] = $this->getStatuses();
        }

        if (in_array("6", $USER->GetUserGroupArray())) {
            $filter['UF_WORKER_ID'] = $this->userId;
        } elseif (in_array("5", $USER->GetUserGroupArray())) {
            $filter['UF_USER_ID'] = $this->userId;
            $this->arResult['IS_USER'] = true;
        }
        if (in_array("1", $USER->GetUserGroupArray())) {
            $filter = [];
            $this->arResult['IS_USER'] = false;
        }

        $this->taskList = $this->entity::getList([
            "select" => array("*"),
            "order" => array("ID" => "ASC"),
            "filter" => $filter
        ])->fetchAll();

        $this->statuses = HighloadTool::getStatuses();
        foreach ($this->taskList as &$task) {
            if ($task['UF_STATUS']) {
                $statusName = HighloadTool::getStatusById($task['UF_STATUS']);
                $task['STATUS_NAME'] = $statusName['UF_NAME'];
            }
        }
        unset($task);




        if ($this->request->isPost()) {
            HighloadTool::closeTask($this->request->get('id'));
            $APPLICATION->RestartBuffer();

        }

        $this->arResult['TASKS'] = $this->taskList;
        $this->arResult['STATUSES'] = $this->statuses;

        $this->includeComponentTemplate();
    }

    public function getAdmins() {
        $filter = ['ACTIVE' => 'Y', 'GROUPS_ID' => '6'];
        $rsUsers = CUser::GetList(
            ($by="personal_country"),
            ($order="desc"),
            $filter,
            ['SELECT' => ['NAME', 'ID', 'GROUPS_ID']]);

        $admins = [];
        while ($user = $rsUsers->Fetch()) {
            $admins[] = $user;
        }

        return $admins;

    }

    public function getStatuses() {
        return HighloadTool::getStatuses();
    }

}
