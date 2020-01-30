<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();


echo "<strong>Каталог</strong><ul>";
foreach ($arResult["MANUFACTURERS"] as $manufacturer) :
    echo "<li><strong>{$manufacturer["NAME"]}</strong>"; ?>
    <?foreach ($arResult["PRODUCTS"] as $elem) :?>
        <?if (in_array($manufacturer["ID"], $elem["PROPERTY_FIRMS_IDS"])):?>
            <ul>
                <li><a href="<?=$elem["TEMPLATE_DETAIL_VIEW_LINK"]?>"><?="{$elem["NAME"]} - {$elem["PROPERTY_MATERIAL_VALUE"]} - {$elem["PROPERTY_ARTNUMBER_VALUE"]}"?></a></li>
            </ul>
        <?endif;?>
    <?endforeach;
    echo "</li>";
endforeach;
echo "</ul>";