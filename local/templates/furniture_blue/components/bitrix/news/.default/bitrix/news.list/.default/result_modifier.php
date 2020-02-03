<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (!empty($arParams["SET_SPECIALDATE"]) && $arParams["SET_SPECIALDATE"] == "Y") {
    $cp = $this->__component;
    $arResult["ITEM_ACTIVE_FROM"] = $arResult["ITEMS"][0]["ACTIVE_FROM"];
    $cp->SetResultCacheKeys(array("ITEM_ACTIVE_FROM"));
}



