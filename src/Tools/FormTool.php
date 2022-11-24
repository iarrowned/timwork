<?php

namespace Tools;

use Bitrix\Main\Request;
use Bitrix\Main\Loader;

class FormTool
{
    public static function updateFormResult(Request $request) {
        Loader::includeModule('form');

        $resultId = $request->get('result_id');
        $values = [
            "form_text_1" => $request->get('form_text_1'),
            "form_text_2" => $request->get('form_text_2'),
            "form_text_3" => $request->get('form_text_3'),
            "form_text_4" => $request->get('form_text_4'),
            "form_email_5" => $request->get('form_email_5'),
            "form_textarea_6" => $request->get('form_textarea_6'),
        ];

        $res = \CFormResult::Update(
            $resultId,
            $values,
            'N',
            'N'
        );
        dump($res);
    }
}