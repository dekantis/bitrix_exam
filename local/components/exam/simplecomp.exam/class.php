<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

class SimpleComponent extends CBitrixComponent
{

    protected $manufacturerLinksIds;
    protected $manufacturerIDs;

    public function onPrepareComponentParams($arParams)
    {
        $result = array(
            "CACHE_TYPE" => $arParams["CACHE_TYPE"],
            "CACHE_TIME" => isset($arParams["CACHE_TIME"]) ? $arParams["CACHE_TIME"] : 36000000,
            "IBLOCK_PRODUCTS_ID" => $arParams["IBLOCK_PRODUCTS_ID"],
            "IBLOCK_MANUFACTURER_ID" => $arParams["IBLOCK_MANUFACTURER_ID"],
            "TEMPLATE_DETAIL_VIEW_LINK" => $arParams["TEMPLATE_DETAIL_VIEW_LINK"],
            "PRODUCT_PROPERTY_CODE" => $arParams["PRODUCT_PROPERTY_CODE"],

        );
        return $result;
    }

    //Список производителей
    protected function getManufacturersList()
    {
        $arFilter = array(
            "IBLOCK_ID" => $this->arParams["IBLOCK_MANUFACTURER_ID"],
            "ACTIVE" => "Y"
        );
        $object = CIBlockElement::GetList(
            false,
            $arFilter,
            false,
            false,
            array("ID", "NAME")
        );
        while ($manufacturer = $object->GetNext()) {
            $manufacturers[] = $manufacturer;
            $this->manufacturerIDs[] = $manufacturer["ID"];
        }
        return $manufacturers;
    }

    //Список товаров
    protected function getProductsList()
    {
        $arFilter = array(
            "IBLOCK_ID" => $this->arParams["IBLOCK_PRODUCTS_ID"],
            'ACTIVE' => 'Y',
            "ID" => CIBlockElement::SubQuery(
                "ID",
                array(
                    "IBLOCK_ID" => $this->arParams["IBLOCK_PRODUCTS_ID"],
                    "PROPERTY_".$this->arParams["PRODUCT_PROPERTY_CODE"].".ID" => $this->manufacturerIDs)
            ),
        );
        $arSelect = array(
            "ID",
            "NAME",
            "PROPERTY_".$this->arParams["PRODUCT_PROPERTY_CODE"].".ID",
            "PROPERTY_PRICE",
            "PROPERTY_MATERIAL",
            "PROPERTY_ARTNUMBER",
            "IBLOCK_SECTION_ID"
        );
        $object = CIBlockElement::GetList(
            false,
            $arFilter,
            false,
            false,
            $arSelect
        );
        $count = 1;
        for ($i=0;$elemProd = $object->GetNext();$i++) {
            if (!empty($arElemProds) && $elemProd["ID"] == $arElemProds[$i-$count]["ID"])
            {
                $arElemProds[$i-$count]["PROPERTY_FIRMS_IDS"][] = $elemProd["PROPERTY_".$this->arParams["PRODUCT_PROPERTY_CODE"]."_ID"];
                $count++;
            }
            else {
                $count = 1;
                $arElemProds[$i] = $elemProd;
                $arElemProds[$i]["PROPERTY_FIRMS_IDS"][] = $elemProd["PROPERTY_".$this->arParams["PRODUCT_PROPERTY_CODE"]."_ID"];

                $this->arParams["TEMPLATE_DETAIL_VIEW_LINK"] = str_replace(
                    array("#SECTION_CODE#","#ELEMENT_ID#"),
                    array($elemProd["IBLOCK_SECTION_ID"], $elemProd["ID"]),
                    $this->arParams["TEMPLATE_DETAIL_VIEW_LINK"]
                );
                $arElemProds[$i]["TEMPLATE_DETAIL_VIEW_LINK"] = $this->arParams["TEMPLATE_DETAIL_VIEW_LINK"];
            }
            if (!empty($elemProd["PROPERTY_".$this->arParams["PRODUCT_PROPERTY_CODE"]."_ID"]) &&
                !in_array($elemProd["PROPERTY_".$this->arParams["PRODUCT_PROPERTY_CODE"]."_ID"], $this->manufacturerLinksIds))
            {
                $this->manufacturerLinksIds[] = $elemProd["PROPERTY_".$this->arParams["PRODUCT_PROPERTY_CODE"]."_ID"];
            }
        }
        return $arElemProds;
    }

    protected function setCatalogTitle($count)
    {
        global $APPLICATION;
        $APPLICATION->SetTitle("В каталоге товаров представлено товаров: " . $count);
    }

    public function executeComponent()
    {
        if ($this->startResultCache()) {
            $this->arResult["MANUFACTURERS"] = $this->getManufacturersList();
            $this->arResult["PRODUCTS"] = $this->getProductsList();
            $this->setCatalogTitle(count($this->arResult["PRODUCTS"]));
            $this->includeComponentTemplate();
        }
        return $this->arResult;
    }
}