<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Список заявок");
global $USER;
//if (!$USER->IsAuthorized()) die();
?><main>
<div class="container">
    <h1>Список заявок</h1>
        <?$APPLICATION->IncludeComponent("bitrix:form.result.list", "task_list", Array(
	"COMPONENT_TEMPLATE" => ".default",
		"WEB_FORM_ID" => "1",	// ID веб-формы
		"SEF_MODE" => "N",	// Включить поддержку ЧПУ
		"NAME_TEMPLATE" => "",
		"VIEW_URL" => "result_view.php",	// Страница просмотра результата
		"EDIT_URL" => "result_edit.php",	// Страница редактирования результата
		"NEW_URL" => "result_new.php",	// Страница добавления результата
		"SHOW_ADDITIONAL" => "N",	// Показать дополнительные поля веб-формы
		"SHOW_ANSWER_VALUE" => "N",	// Показать значение параметра ANSWER_VALUE
		"SHOW_STATUS" => "Y",	// Показать текущий статус результата
		"NOT_SHOW_FILTER" => array(	// Коды полей которые нельзя показывать в фильтре
			0 => "",
			1 => "",
		),
		"NOT_SHOW_TABLE" => array(	// Коды полей которые нельзя показывать в таблице
			0 => "",
			1 => "",
		),
		"CHAIN_ITEM_TEXT" => "",	// Название дополнительного пункта в навигационной цепочке
		"CHAIN_ITEM_LINK" => "",	// Ссылка на дополнительном пункте в навигационной цепочке
	),
	false
);?>
</div>
 </main><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>