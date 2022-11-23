<?php

use Bitrix\Iblock\Iblock;
use Bitrix\Main\Loader;

require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';
global $APPLICATION;
Loader::includeModule('iblock');


$APPLICATION->IncludeComponent("bitrix:form.result.new", "ajax",
    [
        'SEF_MODE' => 'N',
        'LIST_URL' => '/ajax/form_success.php',
        'EDIT_URL' => '/ajax/form_success.php',
    ]
);