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
?>
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
<div id="oil" style="width: 500px; height: 400px;"></div>

