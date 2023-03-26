<?php use Tools\HighloadTool;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty('title', 'Timwork - регистрация');
require($_SERVER["DOCUMENT_ROOT"] . "/src/Tools/HighloadTool.php");
use Bitrix\Main\Page\Asset;
$asset = Asset::getInstance();
$asset->addCss('/local/components/custom/form/templates/.default/style.css');
$departs = HighloadTool::getDeparts();
?>
    <div class="container">
        <div class="form_container" style="height: 450px">
            <h1>Запрос на регистрацию</h1>
            <form action="/ajax/actions.php" method="post" class="form-register">
                <input type="hidden" name="action" value="register">
                <div class="input_group">
                    <input type="text" class="name_input" required name="UF_FIO" placeholder="Ваше ФИО">
                </div>
                <div class="input_group">
                    <input type="email" class="location_input" required name="UF_EMAIL" placeholder="Ваш email">
                </div>
                <div class="input_group">
                    <input type="tel" required name="UF_PHONE" placeholder="Ваш телефон" class="location_input">
                </div>
                <input class="btn submit-btn" type="submit" name="Login" value="Отправить" />
            </form>
            <div class="success-from">
                <p></p>
            </div>
        </div>
    </div>
<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>