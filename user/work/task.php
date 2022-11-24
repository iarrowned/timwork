<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
use Bitrix\Main\Context;
use Bitrix\Main\Loader;
Loader::includeModule('form');

$request = Context::getCurrent()->getRequest();
$id = $request->get('ID');

$arAnswer = CFormResult::GetDataByID(
    $id,
    array(),
    $arResult,
    $arAnswer2);
?>
<div class="task-form">
    <form action="/ajax/actions.php?action=update_result&result_id=<?= $id ?>" method="post" class="form my_form">
        <?=bitrix_sessid_post()?>
        <input type="hidden" name="WEB_FORM_ID" value="1">
        <input type="hidden" name="web_form_submit" value="Y">
        <input type="text" autocomplete="off" name="form_text_1" placeholder="Имя" value="<?= $arAnswer['NAME'][0]['USER_TEXT'] ?>">
        <input type="text" autocomplete="off" name="form_text_2" placeholder="Место проведения работ" value="<?= $arAnswer['LOCATION'][0]['USER_TEXT'] ?>">
        <input type="text" autocomplete="off" name="form_text_3" placeholder="Отдел" value="<?= $arAnswer['DEPARTAMENT'][0]['USER_TEXT'] ?>">
        <input type="tel" autocomplete="off" name="form_text_4" placeholder="Телефон" value="<?= $arAnswer['PHONE'][0]['USER_TEXT'] ?>">
        <input type="email" autocomplete="off" name="form_email_5" placeholder="E-mail" value="<?= $arAnswer['EMAIL'][0]['USER_TEXT'] ?>">
        <textarea name="form_textarea_6" autocomplete="off" cols="30" rows="10"><?= $arAnswer['COMMENT'][0]['USER_TEXT'] ?></textarea>
        <button class="btn" type="submit">Отправить</button>
    </form>
</div>


<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
