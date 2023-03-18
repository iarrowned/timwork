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
?>
<div class="container">
    <?php if ($arResult['COMMENTS']): ?>
    <h2 style="font-size: 28px; font-weight: bold">Комментарии</h2>
    <div class="comments">
        <?php foreach ($arResult['COMMENTS'] as $comment): ?>
            <div class="comment">
                <p class="comment-user"><?= $comment['USER_NAME'] . ' ' . $comment['USER_LAST_NAME']?></p>
                <p class="comment-message"><?= $comment['UF_MESSAGE'] ?></p>
                <?php if ((int)$comment['UF_USER_ID'] === (int)$USER->GetID()): ?>
                    <a class="delete-comment" data-id="<?= $comment['ID']?>">Удалить</a>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
    <div class="js-form-container">
        <h2 style="font-size: 28px; font-weight: bold">Оставьте комментарий</h2>
        <form action="" method="post" class="form my_form comment-form">
            <input type="hidden" name="USER_ID" value="<?= $USER->GetID() ?>">
            <input type="hidden" name="TASK_ID" value="<?= $arParams['TASK_ID'] ?>">
            <textarea name="UF_MESSAGE" required cols="30" rows="10"></textarea>
            <button class="btn" type="submit">Отправить</button>
        </form>
        <div class="success-from">
            <p></p>
        </div>

    </div>
</div>


