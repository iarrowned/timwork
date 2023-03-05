<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/src/Tools/HighloadTool.php';
use Tools\HighloadTool;
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
}