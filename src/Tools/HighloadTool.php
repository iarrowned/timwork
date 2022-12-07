<?php

namespace Tools;

use Bitrix\Highloadblock\HighloadBlockTable;
use Bitrix\Main\Loader;

class HighloadTool
{

    const TASK_HL_CODE = 'UserTasks';
    const STATUSES_HL_CODE = 'Statuses';

    public static function getTaskEntity() {
        Loader::includeModule("highloadblock");
        return HighloadBlockTable::compileEntity(self::TASK_HL_CODE)->getDataClass();
    }

    public static function getStatusesEntity() {
        Loader::includeModule("highloadblock");
        return HighloadBlockTable::compileEntity(self::STATUSES_HL_CODE)->getDataClass();
    }

    public static function getStatuses() {

        $entity = self::getStatusesEntity();
        $statuses = $entity::getList([
            "select" => array("*"),
            "order" => array("ID" => "ASC"),
            "filter" => array()
        ])->fetchAll();

        return $statuses;
    }

    public static function getStatusById($id) {
        $entity = self::getStatusesEntity();
        return $entity::getList([
            "select" => array("*"),
            "order" => array("ID" => "ASC"),
            "filter" => array('ID' => $id)
        ])->fetch();
    }

    public static function prepareFields($data) {
        $preparedData = [
            'UF_USER_NAME' => $data['USER_NAME'],
            'UF_USER_PHONE' => $data['USER_PHONE'],
            'UF_USER_EMAIL' => $data['USER_EMAIL'],
            'UF_USER_MESSAGE' => $data['USER_MESSAGE'],
            'UF_LOCATION' => $data['LOCATION'],
            'UF_DEPART' => $data['DEPART'],
            'UF_USER_ID' => $data['USER_ID'],
            'UF_STATUS' => $data['UF_STATUS'],
        ];

        return $preparedData;
    }
}