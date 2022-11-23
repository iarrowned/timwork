<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Создать заявку");
global $USER;
//if (!$USER->IsAuthorized()) die();
?>
    <div class="task-form">
        <form action="/ajax/send.php" method="post" class="form my_form">
            <?=bitrix_sessid_post()?>
            <input type="hidden" name="WEB_FORM_ID" value="1">
            <input type="hidden" name="web_form_submit" value="Y">
            <input type="text" autocomplete="off" disabled name="form_text_1" placeholder="Имя" value="<?= $USER->GetLastName() . ' ' . $USER->GetFirstName() ?>">
            <input type="text" autocomplete="off" name="form_text_2" placeholder="Место проведения работ">
            <input type="text" autocomplete="off" name="form_text_3" placeholder="Отдел">
            <input type="tel" autocomplete="off" name="form_text_4" placeholder="Телефон">
            <input type="email" autocomplete="off" name="form_email_5" placeholder="E-mail">
            <textarea name="form_textarea_6" autocomplete="off" cols="30" rows="10"></textarea>
            <button class="btn" type="submit">Отправить</button>
        </form>
    </div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>