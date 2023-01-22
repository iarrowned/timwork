<?php

namespace Tools;

use Bitrix\Main\Loader;
use Tools\HighloadTool;

class Task
{

    protected array $fields;
    protected string $entity;
    protected array $entityFields;

    protected const REQUIRED_FIELDS = [
        'UF_USER_NAME',
        'UF_USER_EMAIL',
        'UF_USER_PHONE',
        'UF_USER_MESSAGE',
        'UF_LOCATION',
        'UF_DEPART',
        'UF_STATUS'
    ];

    public function __construct(array $fields) {
        Loader::includeModule('highloadblock');
        $this->entity = HighloadTool::getTaskEntity();
        $this->entityFields = self::getEntityFieldsName();
        $this->fields = self::prepareFields($fields);
    }

    public function save() {

        $errors = [];
        foreach ($this->fields as $key => $value) {
            if (!$value && in_array($key, self::REQUIRED_FIELDS)) {
                $errors[] = "Field $key is required";
            }
        }

        if ($errors) {
            return [
                'success' => false,
                'errors' => $errors
            ];
        }

        return [
            'success' => true,
            'data' => $this->entity::add($this->fields)
        ];
    }

    protected static function prepareFields(array $fields): array
    {
        $preparedFields = [];
        $entityFields = self::getEntityFieldsName();
        foreach ($entityFields as $key => $fieldName) {
            if (array_key_exists($fieldName, $fields)) {
                $preparedFields[$fieldName] = $fields[$fieldName];
            } else {
                $preparedFields[$fieldName] = null;
            }
        }
        unset($preparedFields['ID']);

        return $preparedFields;
    }

    public function setFields(array $fields): Task
    {
        $this->fields = self::prepareFields($fields);
        return $this;
    }
    public static function getEntityFieldsName(): array
    {
        $entity = HighloadTool::getTaskEntity();
        $fields = $entity::getEntity()->getFields();
        $arFields = [];

        foreach ($fields as $key => $field) {
            $arFields[] = $key;
        }

        return $arFields;
    }

    public static function loadById($id): array
    {
        $taskEntity = HighloadTool::getTaskEntity();
        return $taskEntity::getList([
            'select' => ['*'],
            'filter' => ['=ID' => $id],
        ])->fetch() ?: [];
    }
    public static function updateTask(array $fields, int $id): bool
    {
        $entity = HighloadTool::getTaskEntity();
        $preparedFields = self::prepareFields($fields);
        foreach ($preparedFields as $key => $value) {
            if (!$value) {
                unset($preparedFields[$key]);
            }
        }

        $result = $entity::update($id, $preparedFields);

        if (!$result->isSuccess()) {
            return false;
        }

        return true;
    }

}