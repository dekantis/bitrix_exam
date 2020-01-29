<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

class SimpleComponent extends CBitrixComponent
{

    CONST ELEM_PROPERIES = array(
        "PRICE" => 2,
        "MATERIAL" => 7,
        "ARTICULE" => 6
    );
    protected $arFilterSectProdNewsIds = [];
    protected $filterSectionsID;
    protected $filterElemsID;

    public function onPrepareComponentParams($arParams)
    {
        $result = array(
            "CACHE_TYPE" => $arParams["CACHE_TYPE"],
            "CACHE_TIME" => isset($arParams["CACHE_TIME"]) ? $arParams["CACHE_TIME"] : 36000000,
            "IBLOCK_PRODUCTS_ID" => $arParams["IBLOCK_PRODUCTS_ID"],
            "IBLOCK_NEWS_ID" => $arParams["IBLOCK_NEWS_ID"],
            "SECTIONS_USER_FIELDS_CODE" => $arParams["SECTIONS_USER_FIELDS_CODE"]

        );
        return $result;
    }


    //список разделов в инфоблоке "Продукция"
    protected function getSectionsList ()
    {
        $arFilter = array("IBLOCK_ID" => $this->arParams["IBLOCK_PRODUCTS_ID"]);
        $object = CIBlockSection::GetList(false, $arFilter,false, array($this->arParams["SECTIONS_USER_FIELDS_CODE"], "ID", "NAME"));
        while($sectionProd = $object->GetNext())
        {
            if(!empty($sectionProd[$this->arParams["SECTIONS_USER_FIELDS_CODE"]]))
            {
                $this->arFilterSectProdNewsIds = array_merge($sectionProd[$this->arParams["SECTIONS_USER_FIELDS_CODE"]], $this->arFilterSectProdNewsIds);
                $this->filterSectionsID[] = $sectionProd["ID"];
            }
            $arSectionProd[] = $sectionProd;
        }
        $this->arFilterSectProdNewsIds = array_unique($this->arFilterSectProdNewsIds);

        return $arSectionProd;
    }

    //Список Новостей
    protected function getNewsList()
    {
        $arFilter = array("IBLOCK_ID" => $this->arParams["IBLOCK_NEWS_ID"], "ID" => $this->arFilterSectProdNewsIds, "ACTIVE" => "Y");
        $object = CIBlockElement::GetList(false, $arFilter, false, false, array("ACTIVE_FROM", "ID", "NAME"));
        while ($elemNews = $object->GetNext()) {
            foreach ($this->arResult["SECTIONS"] as $section) {
                if (in_array($elemNews["ID"], $section[$this->arParams["SECTIONS_USER_FIELDS_CODE"]])) {
                    $elemNews["SECTIONS_ID"][] = $section["ID"];
                    $elemNews["SECTIONS_NAMES"][] = $section["NAME"];
                }
            }
            $arNews[] = $elemNews;
        }

        return $arNews;
    }

    //Список товаров
    protected function getProductsList()
    {
        $arFilter = array(
            "IBLOCK_ID" => $this->arParams["IBLOCK_PRODUCTS_ID"],
            "IBLOCK_SECTION_ID" => $this->filterSectionsID,
            'ACTIVE' => 'Y'
        );
        $object = CIBlockElement::GetList(
            false,
            $arFilter,
            false,
            false,
            array("ID","NAME", "IBLOCK_SECTION_ID")
        );
        while($elemProd = $object->GetNext())
        {
            $arElemProds[] = $elemProd;
            $this->filterElemsID[] = $elemProd["ID"];
        }

        return $arElemProds;
    }

    //Вывод списка свойств товаров
    protected function setProductsProperties()
    {
        $object = CIBlockElement::GetPropertyValues($this->arParams["IBLOCK_PRODUCTS_ID"], array("ID" => $this->filterElemsID));
        while ($elemProperties = $object->GetNext())
        {
            $arProperties[] = $elemProperties;
        }
        foreach ($this->arResult["PRODUCTS"] as $key=>&$elem)
        {
            $elem["PRICE"] = $arProperties[$key][self::ELEM_PROPERIES["PRICE"]];
            $elem["MATERIAL"] = $arProperties[$key][self::ELEM_PROPERIES["MATERIAL"]];
            $elem["ARTICULE"] = $arProperties[$key][self::ELEM_PROPERIES["ARTICULE"]];
        }
    }

    protected function setCatalogTitle($count)
    {
        global $APPLICATION;
        $APPLICATION->SetTitle("В каталоге товаров представлено товаров: ". $count);
    }

    public function executeComponent()
    {
        if ($this->startResultCache()) {
//            $this->arResult["DATE"] = $this->showDate($this->arParams["TEMPLATE_FOR_DATE"]);
            $this->arResult["SECTIONS"] = $this->getSectionsList();
            $this->arResult["NEWS"] = $this->getNewsList();
            $this->arResult["PRODUCTS"] = $this->getProductsList();
            $this->setCatalogTitle(count($this->arResult["PRODUCTS"]));
            $this->setProductsProperties();
            $this->includeComponentTemplate();
        }
        return $this->arResult;
    }
}