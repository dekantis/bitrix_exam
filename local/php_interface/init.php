<?php

AddEventHandler("iblock", "OnBeforeIBlockElementUpdate", "OnBeforeIBlockElementUpdateHandler");

function OnBeforeIBlockElementUpdateHandler(&$arFields)
{
    if ($arFields["IBLOCK_ID"] == 2 && $arFields["ACTIVE"] == "N")
    {
        $arSelect = Array("SHOW_COUNTER");
        $arFilter = Array("IBLOCK_ID"=>2, "ID" => $arFields["ID"]);
        $object = CIBlockElement::GetList(false, $arFilter, false,false, $arSelect);
        if($product = $object->GetNext())
        {
            if($product["SHOW_COUNTER"] > 2) {
                global $APPLICATION;
                $APPLICATION->throwException("Товар невозможно деактивировать, у него {$product["SHOW_COUNTER"]} просмотров");
                return false;
            }
        }
    }
}