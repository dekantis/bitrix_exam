<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

AddEventHandler("main", "OnBeforeEventAdd", "SetAuthorMacros");

function SetAuthorMacros(&$event, &$lid, &$arFields)
{
    global $USER;
    $arFields["AUTHOR_NAME"] = $arFields["AUTHOR"];
    $arFields["AUTHOR"] = $USER->IsAuthorized() ?
        "Пользователь не авторизован, данные из формы: " . $arFields["AUTHOR_NAME"] :
        "Пользователь авторизован: ".
        $USER->GetID() . "( ". $USER->GetLogin() .
        " ) ".$USER->GetFirstName().", данные из формы:" . $arFields["AUTHOR_NAME"];

    var_dump($arFields);

    global $APPLICATION;
    CEventLog::Add(array(
        "SEVERITY" => "info",
        "AUDIT_TYPE_ID" => "Замена данных в отсылаемом письме",
        "MODULE_ID" => "main",
        "ITEM_ID" => "FEEDBACK_FORM",
        "DESCRIPTION" => $arFields["AUTHOR"],
    ));
}