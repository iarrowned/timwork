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

$data = [
    ['Год', 'Завершено'],
];
$tasks = \Tools\HighloadTool::getTaskEntity()::getList([
        'select' => ['*', 'MONTH'],
        'order' => ['UF_CLOSE_TIME' => 'ASC'],
        'filter' => ['UF_STATUS' => 3],
        'runtime' => [
                new Bitrix\Main\Entity\ExpressionField('MONTH', 'MONTH(UF_CLOSE_TIME)')
        ],
])->fetchAll();
$months = [];
foreach ($tasks as $task) {
    if(!$months[$task['MONTH']]) {
        $months[$task['MONTH']] = 1;
    } else {
        $months[$task['MONTH']]++;
    }
}
$mNames = [
        1 => 'Январь',
        2 => 'Февраль',
        3 => 'Март',
        4 => 'Апрель',
        5 => 'Май',
        6 => 'Июнь',
        7 => 'Июль',
        8 => 'Август',
        9 => 'Сентябрь',
        0 => 'Октябрь',
        11 => 'Ноябрь',
        12 => 'Декабрь',
];
foreach ($months as $month => $count) {
    $data[] = [$mNames[$month], (int)$count];
}
dump($arResult);
?>
<section class="stat">
    <div class="container">
        <h1>НЕМНОГО НАШЕЙ СТАТИСТИКИ</h1>

        <div class="block_0">
            <ul>
                <li>ЗА ВСЕ ВРЕМЯ НАМ ПОСТУПИЛО <span class="task_total"><?= $arResult['TOTAL_TASKS'] ?> ЗАДАЧ</span>:</li>
                <li><span class="task_done"><?= count($arResult['STATS'][2]['TASKS']) ?></span> из них мы успешно выполнили;</li>
                <li>над <span class="task_progress"><?= count($arResult['STATS'][1]['TASKS']) ?></span> сейчас активно трудятся наши специалисты;</li>
                <li><span class="task_block"><?= count($arResult['STATS'][3]['TASKS']) ?> задачи</span> сейчас обсуждаются с заказчиком.</li>
            </ul>
        </div>

        <div class="block_1">
            <div class="b1_top">
                <p><?= $arResult['TIME_STAT']['SUM'] ?> ч.</p>
            </div>
            <div class="b1_bottom">
                <p>МЫ ПОТРАТИЛИ НА ВСЕ ЗАДАЧИ</p>
            </div>
        </div>

        <div class="block_2">
            <div class="b2_top">
                <p>В СРЕДНЕМ НА ЗАДАЧУ</p>
            </div>
            <div class="b2_bottom">
                <p><?= $arResult['TIME_STAT']['DAYS'] ?> ДНЕЙ</p>
            </div>
        </div>

        <div class="block_3">
            <div class="b3_top">
                <p>ЗА <?= $arResult['TIME_STAT']['MIN'][0] ?> ч.</p>
            </div>
            <div class="b3_bottom">
                <p>ЗАВЕРШИЛИ САМУЮ БЫСТРУЮ НАШУ ЗАДАЧУ</p>
            </div>
        </div>

        <div class="block_4">
            <div class="b4_top">
                <p>САМАЯ ДОЛГАЯ ЗАДАЧА ЗАНЯЛА У НАС</p>
            </div>
            <div class="b4_bottom">
                <p><?= $arResult['TIME_STAT']['MAX'][0] ?> ч.</p>
            </div>
        </div>

    </div>
</section>

<!--
<script>
    let arData = <?= json_encode($data) ?>;
</script>
<script src="https://www.google.com/jsapi"></script>
<script>
    google.load("visualization", "1", {packages:["corechart"]});
    google.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable(arData);
        var options = {
            title: 'Статистика',
            hAxis: {title: 'Дата'},
            vAxis: {title: 'Кол-во'}
        };
        var chart = new google.visualization.ColumnChart(document.getElementById('oil'));
        chart.draw(data, options);
    }
</script>
<style>
    #oil {
        width: 800px;
        height: 600px;
        margin: 0 auto;
    }
</style>
<div id="oil" style=""></div>-->


