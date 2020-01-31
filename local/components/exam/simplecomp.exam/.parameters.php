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
        "UF_AUTHOR_TYPE" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("UF_AUTHOR_TYPE"),
            "TYPE" => "STRING",
            "MULTIPLE" => "N",
            "DEFAULT" => "UF_AUTHOR_TYPE",
        ),
        "PROPERTY_USER_LINK" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("PROPERTY_USER_LINK"),
            "TYPE" => "STRING",
            "MULTIPLE" => "N",
            "DEFAULT" => "PROPERTY_USER_LINK",
        ),
        "CACHE_TIME" => array("DEFAULT" => 36000000),
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