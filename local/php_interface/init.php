<?php
AddEventHandler("main", "OnEpilog", "setMetaFromIblockMeta");

function setMetaFromIblockMeta()
{
    $IBLOCK_META = 7;
    global $APPLICATION;

    CModule::IncludeModule("iblock");
    $arFilter = Array(
        "IBLOCK_ID" => $IBLOCK_META,
        "NAME" => $APPLICATION->GetCurUri(),
    );
    $arSelect = array("ID", "NAME", "PROPERTY_TITLE", "PROPERTY_DESCRIPTION");

    $object = CIBlockElement::GetList(
        array(),
        $arFilter,
        false,
        false,
        $arSelect
    );

    if($elem = $object->GetNext())
    {
        $APPLICATION->SetTitle($elem["PROPERTY_TITLE_VALUE"]);
        $APPLICATION->SetPageProperty("description", $elem["PROPERTY_DESCRIPTION_VALUE"]);
    }
}