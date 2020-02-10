<?php
Class CMyModule
{
    function Agent007($days=1)
    {
        if (CModule::IncludeModule("main"))
        {
            $arFilter = Array(
                "ACTIVE" => "Y",
                "DATE_REGISTER_1"=> date("d.m.y", mktime(
                    0, 0, 0, date('m') , date('d') - $days, date('y')
                )),
                "DATE_REGISTER_2" => date("d.m.y"),

            );
            $arSelect = Array(
                "LOGIN"
            );
            $count = 0;
            $object = CUser::GetList(($by="name"), ($order="asc"), $arFilter, array("FIELDS"=>$arSelect));
            while($arr = $object->GetNext())
            {
                $count++;
            }
            $arFilter = Array(
                "ACTIVE" => "Y",
                "GROUPS_ID" => array("1")

            );
            $arSelect = Array(
                "EMAIL"
            );
            $object = CUser::GetList(($by="name"), ($order="asc"), $arFilter, array("FIELDS"=>$arSelect));
            while($arr = $object->GetNext())
            {
                $EMAIL_TO[]= $arr["EMAIL"];
            }
            $arEventFields= array(
                "TEXT"=>"На сайе зарегистрировано $count пользователей за $days дней",
                "EMAIL_TO" => implode(",", $EMAIL_TO)
            );
            CEvent::Send("POST_AGENT", "s1", $arEventFields, 31);
            return "CMyModule::Agent007($days);";
        }
        return "";
    }
}
