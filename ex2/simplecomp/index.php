<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Экзамен №2");
?><?$APPLICATION->IncludeComponent(
	"exam:simplecomp.exam", 
	".default", 
	array(
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"IBLOCK_MANUFACTURER_ID" => "8",
		"IBLOCK_PRODUCTS_ID" => "2",
		"PRODUCT_PROPERTY_CODE" => "FIRM_LINKS",
		"TEMPLATE_DETAIL_VIEW_LINK" => "/products/#SECTION_ID#/#ELEMENT_ID#",
		"COMPONENT_TEMPLATE" => ".default",
		"IBLOCK_NEWS_ID" => "1",
		"UF_AUTHOR_TYPE" => "UF_AUTHOR_TYPE",
		"PROPERTY_USER_LINK" => "PROPERTY_USER_LINK"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>