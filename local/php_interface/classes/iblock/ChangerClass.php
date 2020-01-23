<?php

class ChangerClass
{
    function OnBeforeIBlockElementUpdateHandler(&$arFields)
    {
        if ($arFields["IBLOCK_ID"] == 2 && $arFields["ACTIVE"] == "N") {
            var_dump($arFields["ID"]);//id элемента
            $res = CIBlockElement::GetByID($arFields["ID"]);
            $ar_res = $res->GetNext(false, false);
            $count = $ar_res["SHOW_COUNTER"];
            if ($count > 2) {
                global $APPLICATION;
                $APPLICATION->throwException("Товар невозможно деактивировать, у него $count просмотров");
                return false;
            }
        }
    }
}