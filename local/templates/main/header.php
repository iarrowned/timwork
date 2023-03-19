<?php
use Bitrix\Main\Page\Asset;
global $USER;
$isAdmin = true;
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <?php $APPLICATION->ShowHead(); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no">
    <meta name="robots" content="index, follow">
    <meta name="description" content="Решение ваших проблем">
    <meta name="og:title" property="og:title" content="Timwork - сервис для решения проблем">
    <meta name="og:description" property="og:description" content="Решение ваших проблем">

    <?php
    $asset = Asset::getInstance();
    $asset->addCss(SITE_TEMPLATE_PATH . '/css/style.css');
    ?>
    <title><?php $APPLICATION->ShowTitle()?></title>
    <link rel="apple-touch-icon" sizes="180x180" href="<?= SITE_TEMPLATE_PATH ?>/img/icon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= SITE_TEMPLATE_PATH ?>/img/icon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= SITE_TEMPLATE_PATH ?>/img/icon/favicon-16x16.png">
    <link rel="manifest" href="<?= SITE_TEMPLATE_PATH ?>/img/icon/site.webmanifest">
</head>
<?php $APPLICATION->ShowPanel(); ?>
<body>
<header class="header">
    <div class="container1">
        <nav class="menu">
            <ul>
                <li><a href="/">Главная</a></li>
                <li><a href="/user/new.php">Новая заявка</a></li>
                <li><a href="<?= $isAdmin ? '/work/list.php' : '/user/list.php'?>">Список заявок</a></li>
                <li><a href="/info/">Статистика</a></li>
                <li><a href="/user/index.php"><?= $USER->IsAuthorized() ? 'Профиль' : 'Войти в систему' ?></a></li>
            </ul>
        </nav>
    </div>

</header>