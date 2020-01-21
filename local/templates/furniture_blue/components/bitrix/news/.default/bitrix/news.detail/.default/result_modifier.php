<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arFilter = Array("IBLOCK_ID" => 5);

$res = CIBlockElement::GetList(array("SORT" => "ASC"), $arFilter, false);

$time_items = array();
while($ob = $res->GetNextElement())
{
    $arCanonicalProperties = $ob->GetProperties("CANONICAL_NEWS");
    if ($arCanonicalProperties["CANONICAL_NEWS"]["VALUE"] == $arParams["ID_IBLOCK_CANONICAL"] &&
        $arParams["ID_IBLOCK_CANONICAL"] == $arParams["ELEMENT_ID"])
    {
        $arCanonicalName = $ob->GetFields();
        $APPLICATION->SetPageProperty("canonical", $arCanonicalName["NAME"]);
    }
}




