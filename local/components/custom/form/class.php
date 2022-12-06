<?php

use Bitrix\Main\Application;
use Bitrix\Main\Server;
use Tools\HighloadTool;

require_once $_SERVER['DOCUMENT_ROOT'] . '/src/Tools/HighloadTool.php';

/**
 * Class FormComponent
 */
class FormComponent extends \CBitrixComponent
{

    /**
     * @var Bitrix\Main\Context
     */
    private $context;

    public function onPrepareComponentParams($arParams)
    {
        return parent::onPrepareComponentParams($arParams);
    }

    public function executeComponent()
    {
        global $APPLICATION;

        $this->context = Application::getInstance()->getContext();

        $request = $this->context->getRequest();

        if ($request->isPost() && $request->get('FORM')) {
            $APPLICATION->RestartBuffer();
            $this->postData = $request->getPostList()['FORM'];
            $this->postData = $this->processingData($this->postData);


            if (!$res = $this->insertData($this->postData)) {
                $this->errorOccasion(['К сожалению произошла системная ошибка. Ваше сообщение не было зафиксировано']);
            }

            $entity = HighloadTool::getTaskEntity();
            $preparedFields = HighloadTool::prepareFields($res);
            $this->arResult['PREPARED'] = $preparedFields;
            $r = $entity::add($preparedFields);
            $this->arResult['RESULT'] = $r;
        }

        $this->includeComponentTemplate();
    }

    private function insertData(array $fields)
    {
        if (!$fields['USER_PHONE']) {
            $fields['USER_PHONE'] = '(не указан)';
        }

        if (!$fields['USER_NAME']) {
            $fields['USER_NAME'] = '(не указано)';
        }

        if (!$fields['USER_EMAIL']) {
            $fields['USER_EMAIL'] = '(не указан)';
        }

        if (!$fields['USER_MESSAGE']) {
            $fields['USER_MESSAGE'] = '-';
        }

        if (!$fields['DEPART']) {
            $fields['DEPART'] = '-';
        }

        if (!$fields['LOCATION']) {
            $fields['LOCATION'] = '-';
        }

        return $fields;
    }

    public function errorOccasion($error): void
    {
        $this->arResult['ERROR'] = $error;
        $this->IncludeComponentTemplate();
        die();
    }

    public function processingData($data): ?array
    {
        if (!$data) {
            return null;
        }

        return array_filter($data, function ($item) {
            return !empty($item);
        });
    }

}
