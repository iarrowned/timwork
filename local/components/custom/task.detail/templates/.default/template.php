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
?>

<div class="container">
    <div class="task-form js-form-container">
        <form action="" method="post" class="form my_form">
            <input type="hidden" name="FORM[USER_ID]" value="<?= $USER->GetID() ?>">
            <input type="text" autocomplete="off" name="FORM[USER_NAME]" disabled placeholder="Имя" value="<?= $arResult['UF_USER_NAME'] ?>">
            <input type="text" autocomplete="off" name="FORM[LOCATION]" disabled value="<?= $arResult['UF_LOCATION'] ?>" placeholder="Место проведения работ">
            <input type="text" autocomplete="off" name="FORM[DEPART]" disabled value="<?= $arResult['UF_DEPART'] ?>" placeholder="Отдел">
            <input type="tel" autocomplete="off" name="FORM[USER_PHONE]" disabled value="<?= $arResult['UF_USER_PHONE'] ?>" placeholder="Телефон">
            <input type="email" autocomplete="off" name="FORM[USER_EMAIL]" disabled value="<?= $arResult['UF_USER_EMAIL'] ?>" placeholder="E-mail">
            <textarea name="FORM[USER_MESSAGE]" autocomplete="off" cols="30" rows="10" disabled><?= $arResult['UF_USER_MESSAGE'] ?></textarea>
            <button class="btn" type="submit" disabled>Отправить</button>
        </form>
    </div>
</div>

