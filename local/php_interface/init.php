<?php

AddEventHandler("main", "OnBuildGlobalMenu", "unsetMenuContentRedactor");

function unsetMenuContentRedactor(&$aGlobalMenu, &$aModuleMenu)
{
    global $USER;
    if(in_array(5,CUser::GetUserGroup($USER->GetID())))
    {
        foreach ($aModuleMenu as $key=>$arMenu)
        {
            if ($aModuleMenu[$key]["parent_menu"] != "global_menu_content") {
                unset($aModuleMenu[$key]);
            } elseif ($aModuleMenu[$key]["text"] == "Инфоблоки")
            {
                unset($aModuleMenu[$key]);
            }
        }
        unset($aGlobalMenu["global_menu_desktop"]);
    }
}