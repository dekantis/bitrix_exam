<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
function addComplaint($matches)
{
    ob_start();

    global $USER;
    global $DB;


        $userString = CUser::IsAuthorized() ? "{$USER->GetID()}, {$USER->GetLogin()}, {$USER->GetFullName()}" : "Не авторизован";

        $arFields = Array(
            "IBLOCK_ID" => "9",
            "NAME" => "Жалоба",
            "ACTIVE" => "Y",
            "ACTIVE_FROM" => date($DB->DateFormatToPHP(CSite::GetDateFormat("FULL")), time()),
            "PROPERTY_VALUES" => Array(
                "USER" => $userString,
                "NEWS_LINK" => $matches[1],
            ),
        );
        if(\Bitrix\Main\Loader::includeModule("iblock"))
        {
            $complaintsObject = new CIBlockElement();
            $complaint = $complaintsObject->Add($arFields);
            if ($complaint < 1) {
                echo "<span style=\"color: red\">Ошибка!</span>";
            } else {
                echo "<span style=\"color: red\">Ваше мнение учтено, №$complaint</span>";
            }
        }

    $retrunStr = @ob_get_contents();
    ob_get_clean();
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