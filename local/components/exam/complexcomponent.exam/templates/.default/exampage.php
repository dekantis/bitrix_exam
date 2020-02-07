<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
if (!empty($arResult["VARIABLES"]["PARAM1"]))
{
    echo "PARAM1 = " . $arResult["VARIABLES"]["PARAM1"] . "<br>";
}

if (!empty($arResult["VARIABLES"]["PARAM2"]))
{
    echo "PARAM2 = " . $arResult["VARIABLES"]["PARAM2"];
}
?>