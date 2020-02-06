<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Комопонент");
?><?$APPLICATION->IncludeComponent(
	"exam:simplecomp.exam", 
	".default", 
	array(
		"CACHE_FILTER" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COMPONENT_TEMPLATE" => ".default",
		"IBLOCK_NEWS_ID" => "1",
		"IBLOCK_PRODUCTS_ID" => "2",
		"SECTIONS_USER_FIELDS_CODE" => "UF_NEWS_LINK",
		"NAV_PAGE_COUNT" => "3"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>