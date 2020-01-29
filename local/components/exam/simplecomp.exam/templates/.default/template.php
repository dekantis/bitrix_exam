<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();


echo "<strong>Каталог</strong><ul>";
foreach ($arResult["NEWS"] as $news)
{
    echo "<li><strong>{$news["NAME"]}</strong> - {$news["ACTIVE_FROM"]} ( ".implode(", ", $news["SECTIONS_NAMES"])." )";
    foreach ($arResult["PRODUCTS"] as $elem)
    {
        if (in_array($elem["IBLOCK_SECTION_ID"], $news["SECTIONS_ID"]))
            echo "<ul><li>{$elem["NAME"]} - {$elem["PRICE"]} - {$elem["MATERIAL"]} - {$elem["ARTICULE"]}</li></ul>";
    }
    echo "</li>";
}echo "</ul>";