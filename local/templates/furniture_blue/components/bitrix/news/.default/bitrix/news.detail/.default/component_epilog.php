<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
function addComplaint($matches)
{

    global $APPLICATION;
    $APPLICATION->IncludeFile("/local/templates/furniture_blue/components/bitrix/news/.default/bitrix/news.detail/.default/function.php");
    $retrunStr = templateComplaint($matches[1]);
    return $retrunStr;

};
if ($_GET["ADD"] == "TRUE" && $arParams["DISPLAY_AJAX_COMPLAINTS"] == "N")
{
    echo preg_replace_callback(
        "/#COMPLAINT_AREA_([\d]+)#/is".BX_UTF_PCRE_MODIFIER,
        "addComplaint",
        $arResult["CACHED_TPL"]
    );
}
else
{
    echo $arResult["CACHED_TPL"];
    if($_GET["ADD"] != "TRUE" && $arParams["DISPLAY_AJAX_COMPLAINTS"] == "N"):?>
        <script>
            BX.ready(function(){
                document.getElementById('complaint').innerHTML = '';
            });
        </script>
    <?endif;
}






