<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$cp = $this->__component;
$arFilter = array("IBLOCK_ID" => 5, "CANONICAL_NEWS" => array("VALUE" => $arParams["ID_IBLOCK_CANONICAL"]));
$arSelect = array("NAME");
$res = CIBlockElement::GetList(array(), $arFilter, false,false, $arSelect);
if ($ob = $res->getNext())
{
    $cp->arResult["CANONICAL_NAME"] = $ob["NAME"];
    $cp->SetResultCacheKeys(array("CANONICAL_NAME"));
}


