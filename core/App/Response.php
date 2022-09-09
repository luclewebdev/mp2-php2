<?php

namespace App;


class Response
{
   public static function redirect(?array $params = null):void
    {

        $url = "index.php";

        if($params){

            $url = "?";

            foreach ($params as $key => $value){

                $newParam = $key."=".$value."&";
                $url.=$newParam;
            }


        }






        header("Location: {$url}");
        exit();
    }
}