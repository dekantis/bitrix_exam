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
        global $APPLICATION;
        $APPLICATION->IncludeFile("/local/templates/furniture_blue/components/bitrix/news/.default/bitrix/news.detail/.default/function.php");
        return templateComplaint($this->request);
    }
}
$ajaxRequest = new AjaxRequest($_REQUEST);
$ajaxRequest->setResponse();
echo !empty($ajaxRequest->response) ? $ajaxRequest->response : "<span style=\"color: red\">Ошибка!</span>";