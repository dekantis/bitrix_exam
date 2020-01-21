<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (!empty($arParams["SET_SPECIALDATE"]) && $arParams["SET_SPECIALDATE"] == "Y") {
    $APPLICATION->SetPageProperty("SPECIALDATE", $arResult["ITEMS"][0]["ACTIVE_FROM"]);
}


