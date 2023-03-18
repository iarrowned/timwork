<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/src/Tools/HighloadTool.php';

/**
 * Class FormComponent
 */
class CommentsComponent extends \CBitrixComponent
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
        $this->arResult['COMMENTS'] = \Tools\HighloadTool::getComments($this->arParams['TASK_ID']);

        $this->includeComponentTemplate();
    }


}
