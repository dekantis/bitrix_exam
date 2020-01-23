<?php
session_start();

$path = "/local/php_interface/classes/";
CModule::AddAutoloadClasses(
    '', //
    array(
        // ключ - имя класса, значение - путь относительно корня сайта к файлу с классом
        "ChangerClass" => $path . "iblock/ChangerClass.php",
        "ErrorChekerClass" => $path . "main/ErrorChekerClass.php"
    )
);

AddEventHandler("iblock", "OnBeforeIBlockElementUpdate", Array("ChangerClass", "OnBeforeIBlockElementUpdateHandler"));
AddEventHandler("main", "OnAfterEpilog", Array("ErrorChekerClass", "check404error"));

