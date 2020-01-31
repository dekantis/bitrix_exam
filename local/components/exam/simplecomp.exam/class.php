<?php


if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

class SimpleComponent extends CBitrixComponent
{
    protected $usersIDs;
    protected $curAuthorType;

    public function onPrepareComponentParams($arParams)
    {

        $result = array(
            "CACHE_TYPE" => $arParams["CACHE_TYPE"],
            "CACHE_TIME" => isset($arParams["CACHE_TIME"]) ? $arParams["CACHE_TIME"] : 36000000,
            "IBLOCK_NEWS_ID" => $arParams["IBLOCK_NEWS_ID"],
            "UF_AUTHOR_TYPE" => $arParams["UF_AUTHOR_TYPE"],
            "PROPERTY_USER_LINK" => $arParams["PROPERTY_USER_LINK"],

        );
        return $result;
    }

    //Список пользователй
    protected function getUsersList()
    {

        global $USER;

        if (!$USER->IsAuthorized())
        {
            return false;
        }

        $filter = array("ACTIVE" => "Y", "!{$this->arParams["UF_AUTHOR_TYPE"]}" => false);
        $params = array("SELECT" => array("UF_*"));
        $object = CUser::GetList(($by="ID"), ($order="ASC"), $filter, $params);
        while ($user = $object->Fetch())
        {
            if ($user["ID"] == $USER->GetID())
            {
                $this->curAuthorType = $user[$this->arParams["UF_AUTHOR_TYPE"]];
            }
            else
            {
                $users[] = $user;
            }
        }

        foreach ($users as $key=>$user)
        {
            if ($user[$this->arParams["UF_AUTHOR_TYPE"]] != $this->curAuthorType)
            {

                unset($users[$key]);
            }
            else
            {
                $this->usersIDs[] = $user["ID"];
                unset($users[$key]);
                $users[$key]["ID"] = $user["ID"];
                $users[$key]["NAME"] = $user["LOGIN"];
            }
        }
        return $users;
    }

    //Список новостей
    protected function getNewsList()
    {
        global $USER;

        if (!$USER->IsAuthorized())
        {
            return false;
        }

        $arFilter = array(
            "IBLOCK_ID" => $this->arParams["IBLOCK_NEWS_ID"],
            'ACTIVE' => 'Y',
            "ID" => CIBlockElement::SubQuery(
                "ID",
                array(
                    "IBLOCK_ID" => $this->arParams["IBLOCK_NEWS_ID"],
                    $this->arParams["PROPERTY_USER_LINK"] => $this->usersIDs
                )
            ),
        );
        $arSelect = array(
            "ID",
            "NAME",
            $this->arParams["PROPERTY_USER_LINK"],
        );
        $object = CIBlockElement::GetList(
            false,
            $arFilter,
            false,
            false,
            $arSelect
        );
        $count = 0;
        for ($i = 0; $news = $object->GetNext(); $i++) {

            if (!empty($arNews) && $news["ID"] == $arNews[$i - $count]["ID"] ) {
                $arNews[$i - $count]["USER_IDS"][] = $news["{$this->arParams["PROPERTY_USER_LINK"]}_VALUE"];
                $count++;
            }
            else
            {
                if(!empty($arNews[$i-$count]) && in_array($USER->GetID(), $arNews[$i-$count]["USER_IDS"]))
                {
                    unset($arNews[$i-$count]);
                }
                $count = 1;
                $arNews[$i] = $news;
                $arNews[$i]["USER_IDS"][] = $news["{$this->arParams["PROPERTY_USER_LINK"]}_VALUE"];
            }
        }
        return $arNews;
    }

    protected function setCatalogTitle($count)
    {
        global $APPLICATION;
        $APPLICATION->SetTitle("Выбранных новостей: " . $count);
    }

    public function executeComponent()
    {
        if ($this->startResultCache()) {
            $this->arResult["AUTHORS"] = $this->getUsersList();
            $this->arResult["NEWS"] = $this->getNewsList();
            if(is_array($this->arResult["NEWS"])) $this->setCatalogTitle(count($this->arResult["NEWS"]));
            $this->includeComponentTemplate();
        }
        return $this->arResult;
    }
}