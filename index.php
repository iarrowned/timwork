<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
global $APPLICATION, $USER;
$APPLICATION->SetPageProperty('title', 'Timwork - главная');
if (!$USER->IsAuthorized()) {
    LocalRedirect('/user/', false, '301 Moved Permanently');
}
?>

<div class="container">
    <h1>Добро пожаловать в личный кабинет</h1>
    <div class="main-page">
        <div class="menu-item">
            <a href="/user/new.php">Отправить заявку в УИТ</a>
        </div>
        <div class="menu-item">
            <a href="/work/list.php">История заявок</a>
        </div>
        <div class="menu-item">
            <a href="/user/index.php">Данные профиля</a>
        </div>
    </div>
</div>


<? require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php'); ?>