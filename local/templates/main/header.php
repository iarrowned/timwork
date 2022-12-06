<?php
use Bitrix\Main\Page\Asset;
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <?php $APPLICATION->ShowHead(); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no">
    <meta name="robots" content="index, follow">
    <meta name="description" content="Описание сайта">
    <meta name="og:title" property="og:title" content="<%=title%>">
    <meta name="og:description" property="og:description" content="">
    <?php $APPLICATION->ShowPanel(); ?>
    <?php
    $asset = Asset::getInstance();
    $asset->addCss(SITE_TEMPLATE_PATH . '/css/style.css');
    ?>
    <title><?$APPLICATION->ShowTitle()?></title>
</head>
<body>
<header class="header">
    <div class="container">
        <nav class="menu">
            <ul>
                <li><a href="/user/work/new/">Новая заявка</a></li>
                <li><a href="/user/work/list/">Список заявок</a></li>
            </ul>
        </nav>
    </div>

</header>