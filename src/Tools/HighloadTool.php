<?php

namespace Tools;

use Bitrix\Highloadblock\HighloadBlockTable;
use Bitrix\Main\Loader;
use CUser;

class HighloadTool
{
    const STATUSES = [
        1 => 'new_s',
        2 => 'progress_s',
        3 => 'ready_s',
        4 => 'block_s'
        ];

    const TASK_HL_CODE = 'UserTasks';
    const STATUSES_HL_CODE = 'Statuses';
    const DEPARTS_HL_CODE = 'Departs';
    const REGISTER_HL_CODE = 'Register';
    const COMMENTS_HL_CODE = 'Comments';

    public static function getTaskEntity() {
        Loader::includeModule("highloadblock");
        return HighloadBlockTable::compileEntity(self::TASK_HL_CODE)->getDataClass();
    }

    public static function getRegisterEntity() {
        Loader::includeModule("highloadblock");
        return HighloadBlockTable::compileEntity(self::REGISTER_HL_CODE)->getDataClass();
    }

    public static function getDepartsEntity() {
        Loader::includeModule("highloadblock");
        return HighloadBlockTable::compileEntity(self::DEPARTS_HL_CODE)->getDataClass();
    }

    public static function getDeparts() {
        $entity = self::getDepartsEntity();
        $departs = $entity::getList([
            "select" => array("*"),
            "order" => array("ID" => "ASC"),
            "filter" => array()
        ])->fetchAll();

        return $departs;
    }

    public static function getDepartById($id) {
        $entity = self::getDepartsEntity();
        return $entity::getList([
            "select" => array("*"),
            "order" => array("ID" => "ASC"),
            "filter" => array('ID' => $id)
        ])->fetch();
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

    public static function closeTask($id) {
        $entity = self::getTaskEntity();
        $entity::update($id, [
            'UF_STATUS' => 3,
            'UF_CLOSE_TIME' => date('d.m.Y H:i:s')
        ]);

        return true;
    }

    public static function getCommentsEntity() {
        Loader::includeModule("highloadblock");
        return HighloadBlockTable::compileEntity(self::COMMENTS_HL_CODE)->getDataClass();
    }

    public static function getComments($taskId) {
        $entity = self::getCommentsEntity();
        $comments = $entity::getList([
            'select' => ['ID', 'UF_TASK_ID', 'UF_USER_ID', 'UF_MESSAGE'],
            'filter' => ['UF_TASK_ID' => $taskId]
        ])->fetchAll();
        foreach ($comments as &$comment) {
            $user = CUser::GetList(
                ($by="personal_country"),
                ($order="desc"),
                ['ID' => $comment['UF_USER_ID']],
                ['SELECT' => ['NAME', 'LAST_NAME', 'ID']])->Fetch();
            $comment['USER_NAME'] = $user['NAME'];
            $comment['USER_LAST_NAME'] = $user['LAST_NAME'];
        }
        unset($comment);
        return $comments;
    }

}