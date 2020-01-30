<?
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("test");
?>
<?$APPLICATION->IncludeComponent(
	"exam:simplecomp.exam", 
	".default", 
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"IBLOCK_NEWS_ID" => "1",
		"IBLOCK_PRODUCTS_ID" => "2",
		"SECTIONS_USER_FIELDS_CODE" => "UF_NEWS_LINK",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "N"
	),
	false
);?><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>