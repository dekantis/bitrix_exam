<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Простой компонент");
?><?$APPLICATION->IncludeComponent(
    "exam:simplecomp.exam",
    ".default",
    array(
        "COMPONENT_TEMPLATE" => ".default",
        "IBLOCK_MANUFACTURER_ID" => "8",
        "IBLOCK_PRODUCTS_ID" => "2",
        "TEMPLATE_DETAIL_VIEW_LINK" => "/products/#SECTION_CODE#/#ELEMENT_ID#/",
        "PRODUCT_PROPERTY_CODE" => "FIRM_LINKS",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "36000000",
        "CACHE_FILTER" => "N",
        "CACHE_GROUPS" => "Y"
    ),
    false
);?><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>