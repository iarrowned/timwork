<?php use Tools\HighloadTool;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
require($_SERVER["DOCUMENT_ROOT"] . "/src/Tools/HighloadTool.php");
$departs = HighloadTool::getDeparts();
?>

    <div class="task-form register-form__container js-form-container">
        <h1>Запрос на регистрацию</h1>
        <form action="/ajax/actions.php" method="post" class="form form-register">
            <input type="hidden" name="action" value="register">
            <input type="text" required name="UF_FIO" placeholder="Ваше ФИО">
            <input type="email" required name="UF_EMAIL" placeholder="Ваш email">
            <input type="tel" required name="UF_PHONE" placeholder="Ваш телефон">
            <button class="btn" type="submit">Отправить</button>
        </form>
        <div class="success-from">
            <p></p>
        </div>
    </div>
<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>