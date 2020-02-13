<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

class AjaxRequest
{
    public $response;
    public $request;

    public function __construct($request)
    {
        $this->request = $request["el_id"];
    }
    public function setResponse()
    {
        $this->response = $this->setComplaint();
    }
    private function setComplaint()
    {
        global $USER;
        global $DB;
        $userString = CUser::IsAuthorized() ?
            "{$USER->GetID()},
            {$USER->GetLogin()},
            {$USER->GetFullName()}" :
            "Не авторизован";
        $arFields = Array(
            "IBLOCK_ID" => "9",
            "NAME" => "Жалоба",
            "ACTIVE" => "Y",
            "ACTIVE_FROM" => date($DB->DateFormatToPHP(CSite::GetDateFormat("FULL")), time()),
            "PROPERTY_VALUES" => Array(
                "USER" => $userString,
                "NEWS_LINK" => $this->request,
            ),
        );
        if (\Bitrix\Main\Loader::includeModule("iblock"))
        {
            $complaintsObject = new CIBlockElement();
            $complaint = $complaintsObject->Add($arFields);
            if ($complaint < 1) {
                return "<span style=\"color: red\">Ошибка!</span>";
            } else {
                return "<span style=\"color: red\">Ваше мнение учтено, №$complaint</span>";
            }
        }
    }
}
$ajaxRequest = new AjaxRequest($_REQUEST);
$ajaxRequest->setResponse();
echo !empty($ajaxRequest->response) ? $ajaxRequest->response : "<span style=\"color: red\">Ошибка!</span>";