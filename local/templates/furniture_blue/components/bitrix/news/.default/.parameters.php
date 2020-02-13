<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arTemplateParameters = array(
    "DISPLAY_AJAX_COMPLAINTS" => Array(
        "NAME" => GetMessage("AJAX_COMPLAINTS"),
        "TYPE" => "CHECKBOX",
        "DEFAULT" => "Y",
    ),
);
?>