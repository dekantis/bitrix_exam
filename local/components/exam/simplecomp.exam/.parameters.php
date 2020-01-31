<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$arComponentParameters = array(
    "GROUPS" => array(),
    "PARAMETERS" => array(
        "IBLOCK_MANUFACTURER_ID" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("IBLOCK_MANUFACTURER_ID"),
            "TYPE" => "STRING",
            "MULTIPLE" => "N",
            "DEFAULT" => "8",
        ),
        "IBLOCK_PRODUCTS_ID" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("IBLOCK_PRODUCTS_ID"),
            "TYPE" => "STRING",
            "MULTIPLE" => "N",
            "DEFAULT" => "2",
        ),
        "TEMPLATE_DETAIL_VIEW_LINK" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("TEMPLATE_DETAIL_VIEW_LINK"),
            "TYPE" => "STRING",
            "MULTIPLE" => "N",
            "DEFAULT" => "/products/#SECTION_ID#/#ELEMENT_ID#",
        ),
        "PRODUCT_PROPERTY_CODE" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("PRODUCT_PROPERTY_CODE"),
            "TYPE" => "STRING",
            "MULTIPLE" => "N",
            "DEFAULT" => "FIRM_LINKS",
        ),
        "CACHE_TIME"  =>  array("DEFAULT"=>36000000),
        "CACHE_FILTER" => array(
            "PARENT" => "CACHE_SETTINGS",
            "NAME" => GetMessage("IBLOCK_CACHE_FILTER"),
            "TYPE" => "CHECKBOX",
            "DEFAULT" => "N",
        ),
        "CACHE_GROUPS" => array(
            "PARENT" => "CACHE_SETTINGS",
            "NAME" => GetMessage("CP_BNL_CACHE_GROUPS"),
            "TYPE" => "CHECKBOX",
            "DEFAULT" => "Y",
        ),
    ),
);