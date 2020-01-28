<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Комопонент");
?>



<?


//Список новстей
$arFilterNews = array("IBLOCK_ID"=>"1");
$arNews = CIBlockElement::GetList(false, $arFilterNews, false,false, array("ACTIVE_FROM", "ID","NAME"));
while($resNews=$arNews->GetNext()){
	$productsIds = [];
	$productsNames = [];
	echo $resNews["NAME"]." - НОВОСТЬ ".$resNews["ID"]. "(".$resNews["ACTIVE_FROM"] ." )"."<br>";

	//Список связей разделов (Продукция - Новости)
	$arFilterProd = array("IBLOCK_ID"=>"2","UF_NEWS_LINK" => $resNews["ID"]);
	$arProd=CIBlockSection::GetList(false, $arFilterProd,false, array("UF_NEWS_LINK", "ID", "NAME"));
	echo "( ";
	while($resProd=$arProd->GetNext())
	{
		echo $resProd["NAME"]. ", ";

		//Список товаров
		$arFilterSections = array("IBLOCK_ID"=>"2", "IBLOCK_SECTION_ID" => $resProd["ID"]);
		$arProds = CIBlockElement::GetList(false, $arFilterSections, false,false, array("ID","NAME", "IBLOCK_SECTION_ID"));
		while($resProds=$arProds->GetNext())
		{
			$productsIds[] = $resProds["ID"];
			$productsNames[] = $resProd["NAME"];
		}


	}
	echo " )<br>";
	//Вывод списка товаров
	$iterator = CIBlockElement::GetPropertyValues(2, array('ACTIVE' => 'Y', "ID" => $productsIds), true, array());
	while ($row = $iterator->GetNext())
	{
		echo "<pre>";
		var_dump($row["IBLOCK_ELEMENT_ID"]);
	}
}
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>