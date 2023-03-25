<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/src/Tools/HighloadTool.php';
use Tools\HighloadTool;
use Bitrix\Main\Entity\ExpressionField;
use Bitrix\Main\Entity\Query;
class Statistic extends \CBitrixComponent
{
    public array $allStats;
    public function onPrepareComponentParams($arParams)
    {
        return parent::onPrepareComponentParams($arParams);
    }

    public function executeComponent()
    {
        $this->arResult['STATS'] = self::getStats();
        $this->arResult['TOTAL_TASKS'] = self::getTotalTasks();
        $this->arResult['TIME_STAT'] = self::getTimeStat();
        $this->includeComponentTemplate();
    }

    public static function getStats(): array
    {
        $statuses = HighloadTool::getStatuses();

        foreach ($statuses as &$status) {
            $status['TASKS'] = HighloadTool::getTaskEntity()::getList([
                'select' => ['ID', 'UF_STATUS'],
                'filter' => ['=UF_STATUS' => $status['ID']]
            ])->fetchAll();
        }

        return $statuses ?? [];
    }

    public static function getTimeStat() {
        function int($n): int
        {
            return (int)$n;
        }
        $tasks = [];
        $res = HighloadTool::getTaskEntity()::getList([
            'select' => ['ID', 'UF_START_TIME', 'UF_CLOSE_TIME', 'DIFF'],
            'runtime' => [
                new ExpressionField('DIFF', 'TIMEDIFF(UF_CLOSE_TIME, UF_START_TIME)')

            ]
        ]);
        while($r = $res->fetch()) {
            $tasks[] = array_map('int', explode(':', $r['DIFF']));
        }
        $max = $tasks[0][0];
        $min = $tasks[0][0];

        $s = 0;
        for($i = 0, $iMax = count($tasks); $i < $iMax; $i++) {
            if($tasks[$i][0] > $max) {
                $max = $tasks[$i];
            }
            if($tasks[$i][0] < $min) {
                $min = $tasks[$i];
            }
            $s += $tasks[$i][0]*60*60 + $tasks[$i][1]*60 + $tasks[$i][2];
        }
        $tasks['MAX'] = $max;
        $tasks['MIN'] = $min;
        $tmp = $s / (count($tasks) - 2);
        $h = (int)($tmp / 60 / 60);
        $tmp -= $h * 60 * 60;
        $m = (int)($tmp / 60);
        $tmp -= $m * 60;
        $tasks['DAYS'] =(int)($h / 24);
        $tasks['AVG'] = implode(':', [$h, $m, $tmp]);
        $tasks['SUM'] = (int)($s / 60 / 60);
        return $tasks;
    }

    public static function getTotalTasks() {
        return HighloadTool::getTaskEntity()::getList([
            'select' => ['ID'],
            'count_total' => true
        ])->getCount();
    }
}