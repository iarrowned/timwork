<?php

namespace Tools;

use Bitrix\Highloadblock\HighloadBlockTable;
use Bitrix\Main\Loader;

class HighloadTool
{

    const TASK_HL_CODE = 'UserTasks';
    public static function getTaskEntity() {
        Loader::includeModule("highloadblock");
        return HighloadBlockTable::compileEntity(self::TASK_HL_CODE)->getDataClass();
    }

    public static function prepareFields($data) {
        $preparedData = [
            'UF_USER_NAME' => $data['USER_NAME'],
            'UF_USER_PHONE' => $data['USER_PHONE'],
            'UF_USER_EMAIL' => $data['USER_EMAIL'],
            'UF_USER_MESSAGE' => $data['USER_MESSAGE'],
            'UF_LOCATION' => $data['LOCATION'],
            'UF_DEPART' => $data['DEPART']
        ];

        return $preparedData;
    }
}