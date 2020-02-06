<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$arComponentParameters = array(
    "GROUPS" => array(),
    "PARAMETERS" => array(
        "IBLOCK_NEWS_ID" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("IBLOCK_NEWS_ID"),
            "TYPE" => "STRING",
            "MULTIPLE" => "N",
            "DEFAULT" => "1",
        ),
        "IBLOCK_PRODUCTS_ID" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("IBLOCK_PRODUCTS_ID"),
            "TYPE" => "STRING",
            "MULTIPLE" => "N",
            "DEFAULT" => "2",
        ),
        "NAV_PAGE_COUNT" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("NAV_COUNT"),
            "TYPE" => "STRING",
            "MULTIPLE" => "N",
            "DEFAULT" => "2",
        ),
        "SECTIONS_USER_FIELDS_CODE" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("SECTION_USER_FIELD"),
            "TYPE" => "STRING",
            "MULTIPLE" => "N",
            "DEFAULT" => "UF_NEWS_LINK",
        ),
        "CACHE_TIME"  =>  array("DEFAULT"=>36000000),
        "CACHE_FILTER" => array(
            "PARENT" => "CACHE_SETTINGS",
            "NAME" => GetMessage("IBLOCK_CACHE_FILTER"),
            "TYPE" => "CHECKBOX",
            "DEFAULT" => "N",
        ),
    ),
);
