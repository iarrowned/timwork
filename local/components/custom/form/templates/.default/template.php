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

<div class="container">
    <div class="form_container">
        <h1>Оставьте заявку</h1>
        <form action="" method="post" class="my_form">
            <input type="hidden" name="FORM[UF_USER_ID]" value="<?= $USER->GetID() ?>">
            <select name="FORM[UF_STATUS]" class="form-select" disabled style="display: none">
                <?php foreach ($arResult['STATUSES'] as $status): ?>
                    <option value="<?= $status['ID'] ?>"><?= $status['UF_NAME'] ?></option>
                <?php endforeach; ?>
            </select>
            <div class="input_group">
                <input type="text" class="name_input" required autocomplete="off" name="FORM[UF_USER_NAME]" placeholder="Имя" value="<?= $USER->GetLastName() . ' ' . $USER->GetFirstName() ?>">
            </div>
            <div class="input_group">
                <input type="text" class="location_input" required name="FORM[UF_LOCATION]" placeholder="Место проведения работ (корпус, кафедра, кабинет)">
            </div>
            <div class="input_group">
                <input type="text" class="location_input" name="FORM[UF_DEPART]" required placeholder="Укажите своё подразделение (институт/кафедра/отдел)">
            </div>
            <div class="input_group">
                <input type="tel" class="location_input" required name="FORM[UF_USER_PHONE]" placeholder="Телефон">
            </div>
            <div class="input_group">
                <input type="email" class="location_input" required name="FORM[UF_USER_EMAIL]" placeholder="E-mail">
            </div>
            <p style="padding-top: 0">Опишите, что требуется сделать</p>
            <div class="input_group">
                <textarea name="FORM[UF_USER_MESSAGE]" required class="textarea_input weswap-new"></textarea>
            </div>
            <input class="btn submit-btn" type="submit" name="Login" value="Отправить" />
        </form>
        <div class="success-from">
            <p></p>
            <a href="/work/list.php">Перейти в список заявок</a>
        </div>
    </div>
</div>

