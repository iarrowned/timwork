<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
dump($arResult["arrAnswers"]);

?>


<?php
if ($arResult["FORM_ERROR"] <> '') ShowError($arResult["FORM_ERROR"]);
if ($arResult["FORM_NOTE"] <> '') ShowNote($arResult["FORM_NOTE"]);
?>

<form name="rform_<?=$arResult["filter_id"]?>" method="post" action="<?=POST_FORM_ACTION_URI?>#nav_start">
	<input type="hidden" name="WEB_FORM_ID" value="<?=$arParams["WEB_FORM_ID"]?>" />
	<?=bitrix_sessid_post()?>
	<p>
	    <?=$arResult["pager"]?>
	</p>
	<table class="form-table data-table">
		<thead>
			<tr>
				<th><?=GetMessage("FORM_TIMESTAMP")?><br /><?=SortingEx("s_timestamp")?></th>
				<?php
				$colspan = 4;
				if (is_array($arResult["arrColumns"])): ?>
                    <?php foreach ($arResult["arrColumns"] as $arrCol): ?>
                        <?php if (!is_array($arParams["arrNOT_SHOW_TABLE"]) || !in_array($arrCol["SID"], $arParams["arrNOT_SHOW_TABLE"])): ?>
                            <?php if (($arrCol["ADDITIONAL"]=="Y" && $arParams["SHOW_ADDITIONAL"]=="Y") || $arrCol["ADDITIONAL"]!="Y"): ?>
                                <?php $colspan++; ?>
                                    <th>
                                        <?=$arrCol["RESULTS_TABLE_TITLE"]?>
                                    </th>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
			</tr>
		</thead>


		<?php if(count($arResult["arrResults"]) > 0): ?>
			<tbody>
			<?php $j=0;
			foreach ($arResult["arrResults"] as $arRes):
                $j++; ?>
				<tr>
				    <td><?=$arRes["TSX_0"]?><br /><?=$arRes["TSX_1"]?></td>

                    <?php foreach ($arResult["arrColumns"] as $FIELD_ID => $arrC): ?>
                    <?php if (!is_array($arParams["arrNOT_SHOW_TABLE"]) || !in_array($arrC["SID"], $arParams["arrNOT_SHOW_TABLE"])): ?>
                            <?php if (($arrC["ADDITIONAL"]=="Y" && $arParams["SHOW_ADDITIONAL"]=="Y") || $arrC["ADDITIONAL"]!="Y"):?>
                                <td>
                                    <?php $arrAnswer = $arResult["arrAnswers"][$arRes["ID"]][$FIELD_ID]; ?>
                                    <?php if (is_array($arrAnswer)): ?>
                                        <?php foreach ($arrAnswer as $key => $arrA): ?>
                                            <?php if (trim($arrA["USER_TEXT"]) <> ''): ?>
                                                <?=$arrA["USER_TEXT"]?><br />
                                            <?php endif; ?>

                                            <?php if (trim($arrA["ANSWER_TEXT"]) <> ''): ?>
                                                [<span class='form-anstext'><?=$arrA["ANSWER_TEXT"]?></span>]&nbsp;
                                            <?php endif; ?>
                                            <?php if (trim($arrA["ANSWER_VALUE"]) <> '' && $arParams["SHOW_ANSWER_VALUE"]=="Y"): ?>
                                                (<span class='form-ansvalue'><?=$arrA["ANSWER_VALUE"]?></span>)
                                            <?php endif; ?>
                                                <br />
                                            <?php if (intval($arrA["USER_FILE_ID"])>0):?>
                                                <?php if ($arrA["USER_FILE_IS_IMAGE"]=="Y"): ?>
                                                    <?=$arrA["USER_FILE_IMAGE_CODE"]?>
                                                <?php else: ?>
                                                    <a title="<?=GetMessage("FORM_VIEW_FILE")?>" target="_blank" href="/bitrix/tools/form_show_file.php?rid=<?=$arRes["ID"]?>&hash=<?=$arrA["USER_FILE_HASH"]?>&lang=<?=LANGUAGE_ID?>"><?=$arrA["USER_FILE_NAME"]?></a><br />(<?=$arrA["USER_FILE_SIZE_TEXT"]?>)<br />[&nbsp;<a title="<?=str_replace("#FILE_NAME#", $arrA["USER_FILE_NAME"], GetMessage("FORM_DOWNLOAD_FILE"))?>" href="/bitrix/tools/form_show_file.php?rid=<?=$arRes["ID"]?>&hash=<?=$arrA["USER_FILE_HASH"]?>&lang=<?=LANGUAGE_ID?>&action=download"><?=GetMessage("FORM_DOWNLOAD")?></a>&nbsp;]
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php endforeach;?>
                                    <?php endif;?>
                                </td>
                            <?php endif;?>
                        <?php endif;?>
                    <?php endforeach;?>
			    </tr>
			<?php endforeach;?>
			</tbody>
		<?php endif; ?>

		<?php if ($arParams["HIDE_TOTAL"]!="Y"):?>
		<tfoot>
			<tr>
				<th colspan="<?=$colspan?>"><?=GetMessage("FORM_TOTAL")?>&nbsp;<?=$arResult["res_counter"]?></th>
			</tr>
		</tfoot>
		<?php endif; ?>
	</table>

	<p><?=$arResult["pager"]?></p>
</form>