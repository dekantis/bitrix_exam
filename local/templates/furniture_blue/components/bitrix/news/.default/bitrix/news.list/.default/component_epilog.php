<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if (!empty($arResult["ITEMS"])) {
    $APPLICATION->SetPageProperty("SPECIALDATE", $arResult["ITEMS"][0]["ACTIVE_FROM"]);
}