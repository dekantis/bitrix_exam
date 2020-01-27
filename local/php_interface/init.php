<?php
AddEventHandler("main", "OnEpilog", "setMetaFromIblockMeta");

function setMetaFromIblockMeta()
{
    global $APPLICATION;
    CModule::IncludeModule("iblock");
    $arFilter = Array("IBLOCK_ID" => 7);
    $arSelect = array("fields");
    $res = CIBlockElement::GetList(array("SORT" => "ASC"), $arFilter, false,false);
    while($ob = $res->GetNextElement())
    {
        $arCanonicalFields = $ob->GetFields();
        if ($APPLICATION->GetCurUri() == $arCanonicalFields["NAME"])
        {
            $arCanonicalProperties = $ob->GetProperties();
            foreach ($arCanonicalProperties as $key=>$arCanonicalProperty) {
                if($arCanonicalProperties[$key]["NAME"] == "title" && !empty($arCanonicalProperties[$key]["VALUE"]))
                {
                    $APPLICATION->SetTitle($arCanonicalProperties[$key]["VALUE"]);
                } elseif(!empty($arCanonicalProperties[$key]["NAME"]) && !empty($arCanonicalProperties[$key]["VALUE"]))
                {
                    $APPLICATION->SetPageProperty($arCanonicalProperties[$key]["NAME"], $arCanonicalProperties[$key]["VALUE"]);
                }
            }
            break;
        }
    }
}