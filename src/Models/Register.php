<?php

namespace Tools;

use Bitrix\Main\Loader;

class Register
{

    protected array $fields;
    protected string $entity;
    protected array $entityFields;
    protected const REQUIRED_FIELDS = [
        'UF_FIO',
        'UF_EMAIL',
        'UF_PHONE',
    ];
    public function __construct(array $fields)
    {
        Loader::includeModule('highloadblock');
        $this->entity = HighloadTool::getRegisterEntity();
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

    public static function getEntityFieldsName(): array
    {
        $entity = HighloadTool::getRegisterEntity();
        $fields = $entity::getEntity()->getFields();
        $arFields = [];

        foreach ($fields as $key => $field) {
            $arFields[] = $key;
        }

        return $arFields;
    }

    public static function prepareFields(array $fields): array
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
}