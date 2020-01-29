<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

class SimpleComponent extends CBitrixComponent
{

    CONST IBLOCK_PRODUCT = 2;
    CONST IBLOCK_NEWS = 1;
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
            "TEMPLATE_FOR_DATE" => $arParams["TEMPLATE_FOR_DATE"],
        );
        return $result;
    }

    //test
    private function showDate($x)
    {
        return date($x);
    }

    //список разделов в инфоблоке "Продукция"
    protected function getSectionsList ()
    {
        $arFilter = array("IBLOCK_ID" => self::IBLOCK_PRODUCT);
        $object = CIBlockSection::GetList(false, $arFilter,false, array("UF_NEWS_LINK", "ID", "NAME"));
        while($sectionProd = $object->GetNext())
        {
            if(!empty($sectionProd["UF_NEWS_LINK"]))
            {
                $this->arFilterSectProdNewsIds = array_merge($sectionProd["UF_NEWS_LINK"], $this->arFilterSectProdNewsIds);
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
        $arFilter = array("IBLOCK_ID" => self::IBLOCK_NEWS, "ID" => $this->arFilterSectProdNewsIds, "ACTIVE" => "Y");
        $object = CIBlockElement::GetList(false, $arFilter, false, false, array("ACTIVE_FROM", "ID", "NAME"));
        while ($elemNews = $object->GetNext()) {
            foreach ($this->arResult["SECTIONS"] as $section) {
                if (in_array($elemNews["ID"], $section["UF_NEWS_LINK"])) {
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
            "IBLOCK_ID" => self::IBLOCK_PRODUCT,
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
        $object = CIBlockElement::GetPropertyValues(self::IBLOCK_PRODUCT, array("ID" => $this->filterElemsID));
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

    public function executeComponent()
    {
        if ($this->startResultCache()) {
//            $this->arResult["DATE"] = $this->showDate($this->arParams["TEMPLATE_FOR_DATE"]);
            $this->arResult["SECTIONS"] = $this->getSectionsList();
            $this->arResult["NEWS"] = $this->getNewsList();
            $this->arResult["PRODUCTS"] = $this->getProductsList();
            $this->setProductsProperties();
            $this->includeComponentTemplate();
        }
        return $this->arResult;
    }
}