<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
dump($arResult["arrAnswers"]);

?>
<script>
<!--
function Form_Filter_Click_<?=$arResult["filter_id"]?>()
{
	var sName = "<?=$arResult["tf_name"]?>";
	var filter_id = "form_filter_<?=$arResult["filter_id"]?>";
	var form_handle = document.getElementById(filter_id);

	if (form_handle)
	{
		if (form_handle.className != "form-filter-none")
		{
			form_handle.className = "form-filter-none";
			document.cookie = sName+"="+"none"+"; expires=Fri, 31 Dec 2030 23:59:59 GMT;";
		}
		else
		{
			form_handle.className = "form-filter-inline";
			document.cookie = sName+"="+"inline"+"; expires=Fri, 31 Dec 2030 23:59:59 GMT;";
		}
	}
}
//-->
</script>
<p>
<?=($arResult["is_filtered"] ? "<span class='form-filteron'>".GetMessage("FORM_FILTER_ON") : "<span class='form-filteroff'>".GetMessage("FORM_FILTER_OFF"))?></span>&nbsp;&nbsp;&nbsp;
[ <a href="javascript:void(0)" OnClick="Form_Filter_Click_<?=$arResult["filter_id"]?>()"><?=GetMessage("FORM_FILTER")?></a> ]
</p>
<form name="form1" method="GET" action="<?=$APPLICATION->GetCurPageParam("", array("sessid", "delete", "del_id", "action"), false)?>?" id="form_filter_<?=$arResult["filter_id"]?>" class="form-filter-<?=htmlspecialcharsbx($arResult["tf"]);?>">
<input type="hidden" name="WEB_FORM_ID" value="<?=$arParams["WEB_FORM_ID"]?>" />
<?if ($arParams["SEF_MODE"] == "N"):?><input type="hidden" name="action" value="list" /><?endif?>
<table class="form-filter-table data-table">
	<thead>
		<tr>
			<th colspan="2">&nbsp;</th>
		</tr>
	</thead>
	<tbody>
		<?
		if ($arResult["str_error"] <> '')
		{
		?>
		<tr>
			<td class="errortext" colspan="2"><?=$arResult["str_error"]?></td>
		</tr>
		<?
		} // endif (strlen($str_error) > 0)
		?>
		<tr>
			<td><?=GetMessage("FORM_F_ID")?></td>
			<td><?=CForm::GetTextFilter("id", 45, "", "")?></td>
		</tr>
		<?
		if ($arParams["SHOW_STATUS"]=="Y")
		{
		?>
		<tr>
			<td><?=GetMessage("FORM_F_STATUS")?></td>
			<td><select name="find_status" id="find_status">
				<option value="NOT_REF"><?=GetMessage("FORM_ALL")?></option>
				<?
				foreach ($arResult["arStatuses_VIEW"] as $arStatus)
				{
				?>
				<option value="<?=$arStatus["REFERENCE_ID"]?>"<?=($arStatus["REFERENCE_ID"]==$arResult["__find"]["find_status"] ? " SELECTED=\"1\"" : "")?>><?=$arStatus["REFERENCE"]?></option>
				<?
				}
				?>
			</select></td>
		</tr>
		<tr>
			<td><?=GetMessage("FORM_F_STATUS_ID")?></td>
			<td><?echo CForm::GetTextFilter("status_id", 45, "", "");?></td>
		</tr>
		<?
		} //endif ($SHOW_STATUS=="Y");
		?>
		<tr>
			<td><?=GetMessage("FORM_F_DATE_CREATE")." (".CSite::GetDateFormat("SHORT")."):"?></td>
			<td><?=CForm::GetDateFilter("date_create", "form1", "Y", "", "")?></td>
		</tr>
		<tr>
			<td><?=GetMessage("FORM_F_TIMESTAMP")." (".CSite::GetDateFormat("SHORT")."):"?></td>
			<td><?=CForm::GetDateFilter("timestamp", "form1", "Y", "", "")?></td>
		</tr>
		<?
		if ($arParams["F_RIGHT"] >= 25)
		{
		?>
		<tr>
			<td><?=GetMessage("FORM_F_REGISTERED")?></td>
			<td>
				<select name="find_registered" id="find_registered">
					<option value="NOT_REF"><?=GetMessage("FORM_ALL")?></option>
					<option value="Y"<?=($arResult["__find"]["find_registered"]=="Y" ? " SELECTED=\"1\"" : "")?>><?=GetMessage("FORM_YES")?></option>
					<option value="N"<?=($arResult["__find"]["find_registered"]=="N" ? " SELECTED=\"1\"" : "")?>><?=GetMessage("FORM_NO")?></option>
				</select>
			</td>
		</tr>
		<tr>
			<td><?=GetMessage("FORM_F_AUTH")?></td>
			<td>
				<select name="find_user_auth" id="find_user_auth">
					<option value="NOT_REF"><?=GetMessage("FORM_ALL")?></option>
					<option value="Y"<?=($arResult["__find"]["find_user_auth"]=="Y" ? " SELECTED=\"1\"" : "")?>><?=GetMessage("FORM_YES")?></option>
					<option value="N"<?=($arResult["__find"]["find_user_auth"]=="N" ? " SELECTED=\"1\"" : "")?>><?=GetMessage("FORM_NO")?></option>
				</select></td>
		</tr>
		<tr>
			<td><?=GetMessage("FORM_F_USER")?></td>
			<td><?=CForm::GetTextFilter("user_id", 45, "", "")?></td>
		</tr>
		<?
			if (CModule::IncludeModule("statistic"))
			{
		?>
		<tr>
			<td><?=GetMessage("FORM_F_GUEST")?></td>
			<td><?=CForm::GetTextFilter("guest_id", 45, "", "")?></td>
		</tr>
		<tr>
			<td><?=GetMessage("FORM_F_SESSION")?></td>
			<td><?=CForm::GetTextFilter("session_id", 45, "", "")?></td>
		</tr>
		<?
			} // endif(CModule::IncludeModule("statistic"));
		} // endif($F_RIGHT>=25);
		if (is_array($arResult["arrFORM_FILTER"]) && count($arResult["arrFORM_FILTER"])>0)
		{
			if ($arParams["F_RIGHT"] >= 25)
			{
		?>
		<tr>
			<th colspan="2"><?=GetMessage("FORM_QA_FILTER_TITLE")?></th>
		</tr>
		<?
			} // endif ($F_RIGHT>=25);
			foreach ($arResult["arrFORM_FILTER"] as $arrFILTER)
			{
				$prev_fname = "";

				foreach ($arrFILTER as $arrF)
				{
					if ($arParams["SHOW_ADDITIONAL"] == "Y" || $arrF["ADDITIONAL"] != "Y")
					{
						$i++;
						if ($arrF["SID"]!=$prev_fname)
						{
							if ($i>1)
							{
							?>
			</td>
		</tr>
							<?
							} //endif($i>1);
							?>
		<tr>
			<td>
				<?=htmlspecialcharsbx($arrF["FILTER_TITLE"] ? $arrF['FILTER_TITLE'] : $arrF['TITLE'])?>
				<?=($arrF["FILTER_TYPE"]=="date" ? " (".CSite::GetDateFormat("SHORT").")" : "")?>
			</td>
			<td>
			<?
						} //endif ($fname!=$prev_fname) ;
						switch($arrF["FILTER_TYPE"])
						{
							case "text":
								echo CForm::GetTextFilter($arrF["FID"]);
								break;
							case "date":
								echo CForm::GetDateFilter($arrF["FID"]);
								break;
							case "integer":
								echo CForm::GetNumberFilter($arrF["FID"]);
								break;
							case "dropdown":
								echo CForm::GetDropDownFilter($arrF["ID"], $arrF["PARAMETER_NAME"], $arrF["FID"]);
								break;
							case "exist":
							?>
								<?=CForm::GetExistFlagFilter($arrF["FID"])?>
								<?=GetMessage("FORM_F_EXISTS")?>
							<?
								break;
						} // endswitch
						if ($arrF["PARAMETER_NAME"]=="ANSWER_TEXT")
						{
						?>
				&nbsp;[<span class='form-anstext'>...</span>]
						<?
						}
						elseif ($arrF["PARAMETER_NAME"]=="ANSWER_VALUE")
						{
						?>
				&nbsp;(<span class='form-ansvalue'>...</span>)
						<?
						}
						?>
				<br />
						<?
						$prev_fname = $arrF["SID"];
					} //endif (($arrF["ADDITIONAL"]=="Y" && $SHOW_ADDITIONAL=="Y") || $arrF["ADDITIONAL"]!="Y");

				} // endwhile (list($key, $arrF) = each($arrFILTER));

			} // endwhile (list($key, $arrFILTER) = each($arrFORM_FILTER));
		} // endif(is_array($arrFORM_FILTER) && count($arrFORM_FILTER)>0);
		?></td>
		</tr>
	</tbody>
	<tfoot>
		<tr>
			<th colspan="2">
				<input type="submit" name="set_filter" value="<?=GetMessage("FORM_F_SET_FILTER")?>" /><input type="hidden" name="set_filter" value="Y" />&nbsp;&nbsp;<input type="submit" name="del_filter" value="<?=GetMessage("FORM_F_DEL_FILTER")?>" />
			</th>
		</tr>
	</tfoot>
</table>
</form>
<br />

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
				if (is_array($arResult["arrColumns"]))
				{
					foreach ($arResult["arrColumns"] as $arrCol)
					{
						if (!is_array($arParams["arrNOT_SHOW_TABLE"]) || !in_array($arrCol["SID"], $arParams["arrNOT_SHOW_TABLE"]))
						{
							if (($arrCol["ADDITIONAL"]=="Y" && $arParams["SHOW_ADDITIONAL"]=="Y") || $arrCol["ADDITIONAL"]!="Y")
							{
								$colspan++;
								?>
				<th>
								<?
								if ($arParams["F_RIGHT"] >= 25)
								{
								?>
					<? }//endif($F_RIGHT>=25);?>
								<?=$arrCol["RESULTS_TABLE_TITLE"]?>
				</th><?
							} //endif(($arrCol["ADDITIONAL"]=="Y" && $SHOW_ADDITIONAL=="Y") || $arrCol["ADDITIONAL"]!="Y");
						} //endif(!is_array($arrNOT_SHOW_TABLE) || !in_array($arrCol["SID"],$arrNOT_SHOW_TABLE));
					} //foreach
				} //endif(is_array($arrColumns)) ;
				?>
			</tr>
		</thead>


		<? if(count($arResult["arrResults"]) > 0): ?>
			<tbody>
			<?php $j=0;
			foreach ($arResult["arrResults"] as $arRes):
                $j++;
            ?>
			 <?php if ($arParams["SHOW_STATUS"]=="Y" || $arParams["can_delete_some"] && $arRes["can_delete"]): ?>

				<?php if ($j>1): ?>
				    <tr><td colspan="<?=$colspan?>" class="form-results-delimiter">&nbsp;</td></tr>
			    <?php endif; ?>

				<tr>
					<td colspan="<?=$colspan?>">
					<?php if ($arParams["can_delete_some"] && $arRes["can_delete"]): ?>
                        <input type="checkbox" name="ARR_RESULT[]" value="<?=$arRes["ID"]?>" />
					<?php endif; ?>
					<input type="hidden" name="RESULT_ID[]" value="<?=$arRes["ID"]?>" />ID:&nbsp;<b><?=($arParams["USER_ID"]==$arRes["USER_ID"]) ? "<span class='form-result-id'>".$arRes["ID"]."</span>" : $arRes["ID"]?></b><br />
					<?php if ($arParams["SHOW_STATUS"] == "Y"): ?>
						<?=GetMessage("FORM_STATUS")?>:&nbsp;[&nbsp;<span class="<?=htmlspecialcharsbx($arRes["STATUS_CSS"])?>"><?=htmlspecialcharsbx($arRes["STATUS_TITLE"])?></span>&nbsp;]
						<?php if ($arRes["can_edit"] && ($arParams["F_RIGHT"] >= 20 ||
                                $arParams["F_RIGHT"] >= 15 && ($arParams["USER_ID"]==$arRes["USER_ID"]))): ?>
								<?=GetMessage("FORM_CHANGE_TO")?>
								<input type="hidden" name="STATUS_PREV_<?=intval($GLOBALS["f_ID"])?>" value="<?=$arRes["STATUS_ID"]?>" />
								<select name="STATUS_<?=$arRes["ID"]?>" id="STATUS_<?=$arRes["ID"]?>">
									<option value="NOT_REF"> </option>
							<?php foreach ($arResult["arStatuses_MOVE"] as $arStatus):?>
									<option value="<?=$arStatus["REFERENCE_ID"]?>"><?=$arStatus["REFERENCE"]?></option>
							<?php endforeach; ?>
								</select>
					<?php endif; ?>
					<?php endif; ?>
					</td>
				</tr>
			<?php endif; ?>
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