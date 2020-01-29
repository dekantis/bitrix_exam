<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Комопонент");
?><?$APPLICATION->IncludeComponent(
	"exam:simplecomp.exam",
	"",
	Array(
		"CACHE_FILTER" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"IBLOCK_NEWS_ID" => "1",
		"IBLOCK_PRODUCTS_ID" => "2",
		"SECTIONS_USER_FIELDS_CODE" => "UF_NEWS_LINK"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>