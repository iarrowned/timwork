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
    <form action="" method="post" class="form my_form">
        <input type="hidden" name="FORM[UF_USER_ID]" value="<?= $USER->GetID() ?>">
        <input type="text" required autocomplete="off" name="FORM[UF_USER_NAME]" placeholder="Имя" value="<?= $USER->GetLastName() . ' ' . $USER->GetFirstName() ?>">

        <select name="FORM[UF_STATUS]" class="form-select" disabled style="display: none">
            <?php foreach ($arResult['STATUSES'] as $status): ?>
                <option value="<?= $status['ID'] ?>"><?= $status['UF_NAME'] ?></option>
            <?php endforeach; ?>
        </select>
        <input type="text" required name="FORM[UF_LOCATION]" placeholder="Место проведения работ (корпус, кафедра, кабинет)">
        <input type="text" name="FORM[UF_DEPART]" required placeholder="Укажите своё подразделение (институт/кафедра/отдел)">
        <input type="tel" required name="FORM[UF_USER_PHONE]" placeholder="Телефон">
        <input type="email" required name="FORM[UF_USER_EMAIL]" placeholder="E-mail">
        <textarea name="FORM[UF_USER_MESSAGE]" required cols="30" rows="10"></textarea>
        <button class="btn" type="submit">Отправить</button>
    </form>
    <div class="success-from">
        <p></p>
        <a href="/work/list.php">Перейти в список заявок</a>
    </div>

</div>

