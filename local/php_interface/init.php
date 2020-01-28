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
    $arSelect = array("ID", "NAME");

    $res = CIBlockElement::GetList(
        array(),
        $arFilter,
        false,
        false,
        $arSelect
    );

    if($ob = $res->GetNext())
    {
        $metaProps = CIBlockElement::GetProperty(
            $IBLOCK_META,
            $ob["ID"],
            array()
        );

        while($arMetaProps = $metaProps->Fetch()) {
            if (!empty($arMetaProps["NAME"]) && $arMetaProps["NAME"] == "title")
            {
                $APPLICATION->SetTitle($arMetaProps["VALUE"]);
            }
            elseif (!empty($arMetaProps["NAME"]))
            {
                $APPLICATION->SetPageProperty($arMetaProps["NAME"], $arMetaProps["VALUE"]);
            }
        }
    }
}