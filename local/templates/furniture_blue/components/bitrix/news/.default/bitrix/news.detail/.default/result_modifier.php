<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$cp = $this->__component; // объект компонента
$arFilter = Array("IBLOCK_ID" => 5, "CANONICAL_NEWS" => array("VALUE" => $arParams["ID_IBLOCK_CANONICAL"]));

$res = CIBlockElement::GetList(array("SORT" => "ASC"), $arFilter, false);

$time_items = array();
while($ob = $res->GetNextElement())
{
    $arCanonicalProperties = $ob->GetProperties("CANONICAL_NEWS");
    if ($arParams["ID_IBLOCK_CANONICAL"] == $arParams["ELEMENT_ID"])
    {
        $arCanonicalName = $ob->GetFields();
        $cp->arResult["CANONICAL_NAME"] = $arCanonicalName["NAME"];
        $cp->SetResultCacheKeys(array("CANONICAL_NAME"));
        break;
    }
}
?>




