<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

use Bitrix\Main\Context;
use Bitrix\Main\Application;
use Bitrix\Main\Diag\Debug;

$request = Application::getInstance()->getContext()->getRequest();
$FORM = $request->getPostList()['FORM'];
$FORM = $this->__component->processingData($FORM);
?>

<div class="task-form js-form-container">
    <?php
        if ($request->isPost() && $request->get('FORM')) {
            $APPLICATION->RestartBuffer();
        }
    ?>
    <form action="" method="post" class="form my_form">
        <input type="hidden" name="FORM[USER_ID]" value="<?= $USER->GetID() ?>">
        <input type="text" autocomplete="off" name="FORM[USER_NAME]" placeholder="Имя" value="<?= $USER->GetLastName() . ' ' . $USER->GetFirstName() ?>">
        <select name="FORM[UF_STATUS]" class="form-select" disabled>
            <?php foreach ($arResult['STATUSES'] as $status): ?>
                <option value="<?= $status['ID'] ?>"><?= $status['UF_STATUS'] ?></option>
            <?php endforeach; ?>
        </select>
        <input type="text" autocomplete="off" name="FORM[LOCATION]" placeholder="Место проведения работ">
        <select name="FORM[DEPART]" class="form-select">
            <?php foreach ($arResult['DEPARTS'] as $depart): ?>
                <option value="<?= $depart['ID'] ?>"><?=$depart['UF_DEPART_NAME'] ?></option>
            <?php endforeach; ?>
        </select>
        <input type="tel" autocomplete="off" name="FORM[USER_PHONE]" placeholder="Телефон">
        <input type="email" autocomplete="off" name="FORM[USER_EMAIL]" placeholder="E-mail">
        <textarea name="FORM[USER_MESSAGE]" autocomplete="off" cols="30" rows="10"></textarea>
        <button class="btn" type="submit">Отправить</button>
    </form>
    <?php if ($request->isPost() && $request->get('FORM')):die(); ?><?php endif; ?>
</div>

