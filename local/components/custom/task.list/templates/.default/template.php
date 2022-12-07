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
dump($arResult['TASKS']);
?>
<div class="container task-list-container">
    <table class="task-list">
        <tr class="table-title">
            <th>ID</th>
            <th>Статус</th>
            <th>Имя</th>
            <th>Телефон</th>
            <th>Email</th>
            <th>Место</th>
            <th>Отдел</th>
            <th>Комментарий</th>
            <th>Действия</th>
        </tr>
        <?php foreach ($arResult['TASKS'] as $task): ?>
            <tr>
                <td><?= $task['ID']?></td>
                <td><?= $task['STATUS_NAME'];?></td>
                <td><?= $task['UF_USER_NAME']?></td>
                <td><?= $task['UF_USER_PHONE']?></td>
                <td><?= $task['UF_USER_EMAIL']?></td>
                <td><?= $task['UF_LOCATION']?></td>
                <td><?= $task['DEPART_NAME']?></td>
                <td><?= $task['UF_USER_MESSAGE']?></td>
                <td class="table-actions">
                    <dif class="table-action-container">
                        <a href="#">Редактировать</a>
                        <a href="#">Закрыть</a>
                        <a href="/user/detail.php?id=<?= $task['ID'] ?>">Просмотр</a>
                    </dif>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

