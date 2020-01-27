<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if (!empty($arResult["ITEM_ACTIVE_FROM"])) {

    $APPLICATION->SetPageProperty("SPECIALDATE", $arResult["ITEM_ACTIVE_FROM"]);
}