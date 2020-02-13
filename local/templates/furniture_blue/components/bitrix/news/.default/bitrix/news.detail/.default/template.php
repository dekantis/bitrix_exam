<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
    ob_start();
?>
<div class="news-detail">
	<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult["DETAIL_PICTURE"])):?>
		<img class="detail_picture" border="0" src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" width="<?=$arResult["DETAIL_PICTURE"]["WIDTH"]?>" height="<?=$arResult["DETAIL_PICTURE"]["HEIGHT"]?>" alt="<?=$arResult["NAME"]?>"  title="<?=$arResult["NAME"]?>" />
	<?endif?>
	<?if($arParams["DISPLAY_DATE"]!="N" && $arResult["DISPLAY_ACTIVE_FROM"]):?>
		<div class="news-date"><?=$arResult["DISPLAY_ACTIVE_FROM"]?></div>
	<?endif;?>
	<?if($arParams["DISPLAY_NAME"]!="N" && $arResult["NAME"]):?>
		<h3><?=$arResult["NAME"];?></h3>
	<?endif;?>
	<div class="news-detail">
        <? CUtil::InitJSCore();?>
        <?if($arParams["DISPLAY_AJAX_COMPLAINTS"] == "N"):?>
            <a href="<?=$APPLICATION->GetCurPage()?>?ELEMENT_ID=<?=$arResult["ID"]?>&ADD=TRUE">ПОЖАЛОВАТЬСЯ!</a>
        <?else:?>

            <a href="#" onclick="BX.ajax({
                        url: '<?=$templateFolder.'/ajax.php';?>',
                        data: {'el_id': '<?=$arResult["ID"]?>'},
                        method: 'POST',
                        dataType: 'html',
                        timeout: 30,
                        async: true,
                        processData: true,
                        scriptsRunFirst: true,
                        emulateOnload: true,
                        start: true,
                        cache: false,
                        onsuccess: function(data)
                        {
                            document.getElementById('complaint').innerHTML = data;
                        },
                        onfailure: function()
                        {
                            document.getElementById('complaint').innerHTML = 'Ошибка!';
                        }
                    });">
                ПОЖАЛОВАТЬСЯ!
            </a>
        <?endif;?>
        <div id="complaint">#COMPLAINT_AREA_<?=$arResult["ID"]?>#</div>

        <br><br>

	<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arResult["FIELDS"]["PREVIEW_TEXT"]):?>
		<p><?=$arResult["FIELDS"]["PREVIEW_TEXT"];unset($arResult["FIELDS"]["PREVIEW_TEXT"]);?></p>
	<?endif;?>
	<?if($arResult["NAV_RESULT"]):?>
		<?if($arParams["DISPLAY_TOP_PAGER"]):?><?=$arResult["NAV_STRING"]?><br /><?endif;?>
		<?echo $arResult["NAV_TEXT"];?>
		<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?><br /><?=$arResult["NAV_STRING"]?><?endif;?>
 	<?elseif(strlen($arResult["DETAIL_TEXT"])>0):?>
		<?echo $arResult["DETAIL_TEXT"];?>
 	<?else:?>
		<?echo $arResult["PREVIEW_TEXT"];?>
	<?endif?>
	<div style="clear:both"></div>
	<br />
	<?foreach($arResult["FIELDS"] as $code=>$value):?>
			<?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?=$value;?>
			<br />
	<?endforeach;?>
	<?foreach($arResult["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>

		<?=$arProperty["NAME"]?>:&nbsp;
		<?if(is_array($arProperty["DISPLAY_VALUE"])):?>
			<?=implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);?>
		<?else:?>
			<?=$arProperty["DISPLAY_VALUE"];?>
		<?endif?>
		<br />
	<?endforeach;?>
	</div>
</div>
<?
    $this->__component->arResult["CACHED_TPL"] = @ob_get_contents();
    ob_get_clean();
?>

