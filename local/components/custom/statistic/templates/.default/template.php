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
    ['Год', 'Завершено', 'В работе'],
    ['2022', 110, 3],
    ['2023', 13, 5],
];
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

