<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();


class SimpleComponent extends CBitrixComponent
{
    protected $arFilterSectProdNewsIds = [];
    protected $filterSectionsID;

    public function onPrepareComponentParams($arParams)
    {
        $result = array(
            "CACHE_TYPE" => $arParams["CACHE_TYPE"],
            "CACHE_TIME" => isset($arParams["CACHE_TIME"]) ? $arParams["CACHE_TIME"] : 36000000,
            "IBLOCK_PRODUCTS_ID" => $arParams["IBLOCK_PRODUCTS_ID"],
            "IBLOCK_NEWS_ID" => $arParams["IBLOCK_NEWS_ID"],
            "SECTIONS_USER_FIELDS_CODE" => $arParams["SECTIONS_USER_FIELDS_CODE"],
            "NAV_PAGE_COUNT" => $arParams["NAV_PAGE_COUNT"]
        );
        return $result;
    }


    //список разделов в инфоблоке "Продукция"
    protected function getSectionsList ()
    {
        $arFilter = array(
            "IBLOCK_ID" => $this->arParams["IBLOCK_PRODUCTS_ID"]
        );
        $arSelect = array($this->arParams["SECTIONS_USER_FIELDS_CODE"], "ID", "NAME");
        $object = CIBlockSection::GetList(
            false,
            $arFilter,
            false,
            $arSelect
        );
        while($sectionProd = $object->GetNext())
        {
            if(!empty($sectionProd[$this->arParams["SECTIONS_USER_FIELDS_CODE"]]))
            {
                $this->arFilterSectProdNewsIds = array_merge(
                    $sectionProd[$this->arParams["SECTIONS_USER_FIELDS_CODE"]],
                    $this->arFilterSectProdNewsIds
                );
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
        $arFilter = array(
            "IBLOCK_ID" => $this->arParams["IBLOCK_NEWS_ID"],
            "ID" => $this->arFilterSectProdNewsIds,
            "ACTIVE" => "Y"
        );
        $arNavParams = array(
            "nPageSize" => $this->arParams["NAV_PAGE_COUNT"],   // количество элементов на странице
            "bDescPageNumbering" => "Описание",
            "bShowAll" => true,
        );
        $arSelect = array("ACTIVE_FROM", "ID", "NAME");
        $object = CIBlockElement::GetList(
            false,
            $arFilter,
            false,
            $arNavParams,
            $arSelect
        );
        $this->arResult["NAV_STRING"] = $object->GetPageNavStringEx(
            $navComponentObject, "Странички", "", "N"
        );;
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
            "ACTIVE" => "Y",
        );
        $arSelect = array("ID","IBLOCK_ID", "NAME", "IBLOCK_SECTION_ID", "PROPERTY_PRICE", "PROPERTY_MATERIAL", "PROPERTY_ARTNUMBER");
        $object = CIBlockElement::GetList(
            false,
            $arFilter,
            false,
            false,
            $arSelect
        );
        while($elemProd = $object->GetNext())
        {
            $arElemProds[] = $elemProd;
        }
        return $arElemProds;
    }

    protected function setCatalogTitle($count)
    {
        global $APPLICATION;
        $APPLICATION->SetTitle("В каталоге товаров представлено товаров: ". $count);
    }

    public function executeComponent()
    {
        if (!\Bitrix\Main\Loader::includeModule("iblock")) return false;

        if($this->startResultCache(false, array($_GET["PAGEN_1"], $_GET["SHOWALL_1"]))) {
            $this->arResult["SECTIONS"] = $this->getSectionsList();
            $this->arResult["NEWS"] = $this->getNewsList();
            $this->arResult["PRODUCTS"] = $this->getProductsList();
            $this->includeComponentTemplate();
        }
        $this->setCatalogTitle(count($this->arResult["PRODUCTS"]));
        return $this->arResult;
    }
}