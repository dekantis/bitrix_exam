<?php

class ErrorChekerClass
{
    function check404error()
    {
        if (defined("ERROR_404"))
        {
            global $APPLICATION;
            CEventLog::Add(array(
                "SEVERITY" => "info",
                "AUDIT_TYPE_ID" => "ERROR_404",
                "MODULE_ID" => "main",
                "ITEM_ID" => "ERROR_404",
                "DESCRIPTION" => $APPLICATION->GetCurPageParam(),
            ));
        }
    }
}