<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();


echo "<strong>Авторы и носости</strong><ul>";
//echo "<pre>";
//var_dump($arResult["NEWS"]);
foreach ($arResult["AUTHORS"] as $author) :
    echo "<li><strong>[{$author["ID"]}] - {$author["NAME"]}</strong>"; ?>
    <? foreach ($arResult["NEWS"] as $news) :?>
    <? if (in_array($author["ID"], $news["USER_IDS"])):?>
        <ul>
            <li>
                <?= " - {$news["NAME"]}" ?>
            </li>
        </ul>
    <?endif; ?>
<?endforeach;
    echo "</li>";
endforeach;
echo "</ul>";