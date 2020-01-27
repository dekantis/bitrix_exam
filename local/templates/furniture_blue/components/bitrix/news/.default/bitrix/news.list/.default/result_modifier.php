<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (!empty($arParams["SET_SPECIALDATE"]) && $arParams["SET_SPECIALDATE"] == "Y") {
    $cp = $this->__component;
    $cp->SetResultCacheKeys(array("ITEMS"));
}



