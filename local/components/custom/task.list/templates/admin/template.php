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

$request = Bitrix\Main\Context::getCurrent()->getRequest();

?>
<div class="container task-list-container">
    <table class="task-list">
        <?php
        if ($request->isPost()) {
            $APPLICATION->RestartBuffer();
        }
        ?>
        <tr class="table-title">
            <th>ID</th>
            <th>Статус</th>
            <th>Имя</th>
            <th>Телефон</th>
            <th>Email</th>
            <th>Место</th>
            <th>Отдел</th>
            <th>Комментарий</th>
            <th>Исполнитель</th>
            <th>Действия</th>
        </tr>

        <?php foreach ($arResult['TASKS'] as $task): ?>
            <tr>
                <td class="task-id"><?= $task['ID']?></td>
                <td>
                    <select name="status" id="">
                        <?php foreach ($arResult['STATUSES'] as $status): ?>
                            <option value="<?= $status['ID'] ?>" <?= $status['ID'] == $task['UF_STATUS'] ? 'selected' : '' ?>><?= $status['UF_NAME'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
                <td><?= $task['UF_USER_NAME']?></td>
                <td><?= $task['UF_USER_PHONE']?></td>
                <td><?= $task['UF_USER_EMAIL']?></td>
                <td><?= $task['UF_LOCATION']?></td>
                <td><?= $task['DEPART_NAME']?></td>
                <td><?= $task['UF_USER_MESSAGE']?></td>
                <td>
                    <select name="worker" id="">
                        <?php foreach($arResult['ADMINS'] as $admin): ?>
                            <option value="<?= $admin['ID'] ?>" <?= $admin['ID'] === $task['UF_WORKER_ID'] ? 'selected' : '' ?>><?= $admin['NAME'] . ' ' . $admin['LAST_NAME']?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
                <td class="table-actions">
                    <div class="table-action-container">
                        <?php if ((int)$task['UF_STATUS'] !== 3): ?>
                            <a href="#">Редактировать</a>
                            <a href="?id=<?= $task['ID'] ?>" data-id="<?= $task['ID'] ?>" class="close-task__btn">Закрыть</a>
                        <?php endif; ?>
                        <a href="/ajax/actions.php" data-id="<?= $task['ID'] ?>" class="save-task__btn">Сохранить</a>
                        <a href="/user/detail.php?id=<?= $task['ID'] ?>">Просмотр</a>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php if ($request->isPost()):die(); ?><?php endif; ?>
    </table>
</div>

