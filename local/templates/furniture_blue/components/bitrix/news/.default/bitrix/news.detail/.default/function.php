<?php
function templateComplaint($newsElem)
{
    global $USER;
    global $DB;

    $userString = CUser::IsAuthorized() ? "{$USER->GetID()}, {$USER->GetLogin()}, {$USER->GetFullName()}" : "Не авторизован";

    $arFields = Array(
        "IBLOCK_ID" => "9",
        "NAME" => "Жалоба",
        "ACTIVE" => "Y",
        "ACTIVE_FROM" => date($DB->DateFormatToPHP(CSite::GetDateFormat("FULL")), time()),
        "PROPERTY_VALUES" => Array(
            "USER" => $userString,
            "NEWS_LINK" => $newsElem,
        ),
    );

    if (\Bitrix\Main\Loader::includeModule("iblock")) {
        $complaintsObject = new CIBlockElement();
        $complaint = $complaintsObject->Add($arFields);
        if ($complaint < 1) {
            return "<span style=\"color: red\">Ошибка!</span>";
        } else {
            return "<span style=\"color: red\">Ваше мнение учтено, №$complaint</span>";
        }
    }
    else
    {
        return "Инфоблок не подключен";
    }
}
