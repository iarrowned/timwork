<?php

use Bitrix\Main\Application;
use Bitrix\Main\Server;

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

        $this->arResult['TEST'] = 'TEST';


        if ($request->isPost() && $request->get('FORM')) {
            $APPLICATION->RestartBuffer();
            $this->postData = $request->getPostList()['FORM'];
            $this->postData = $this->processingData($this->postData);
            if (!$this->postData) {
                $this->errorOccasion(['К сожалению мы не смогли обработать ваше обращение. Попробуйте обратиться позже']);
            }
            $this->filePostData = $request->getFileList()['UF_FILE'];
            $this->files = $this->filePostData ? $this->prepareFiles($this->filePostData) : null;

            if (!$APPLICATION->CaptchaCheckCode($this->postData['CAPTCHA_WORD'], $this->postData['CAPTCHA_SID'])) {
                $this->arResult['ERROR'][] = 'Неверно указан текст с картинки';
                $this->arResult['ERROR']['CAPTCHA_ERROR'] = 'Неверно указан текст с картинки';
            }
            $requiredError = $this->checkRequired($this->postData);

            if (!empty($requiredError)) {
                $this->arResult['ERROR'] = isset($this->arResult['ERROR']) ? array_merge($this->arResult['ERROR'], $requiredError) : $requiredError;
            }

            if ($this->arResult['ERROR']) {
                if ($this->anchor === 'hotline') {
                    $this->updateHotlineContacsFields();
                }

                $this->errorOccasion($this->arResult['ERROR']);
            }

            if (!$form = $this->getForm($this->postData['GUID'])) {
                if ($this->anchor === 'hotline') {
                    $this->updateHotlineContacsFields();
                }
                $this->errorOccasion(['К сожалению произошла системная ошибка. Ваше сообщение не было зафиксировано']);
            }

            $fields = $this->processingFields($form['ID']);
            if (!$res = $this->insertData($fields)) {
                $this->errorOccasion(['К сожалению произошла системная ошибка. Ваше сообщение не было зафиксировано']);
            }



        }

        $this->includeComponentTemplate();
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
