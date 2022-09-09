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

    public static function json($responseToClient, ? string $specialMethod = null ){

        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: *');

        if($specialMethod == "delete"){
            header('Access-Control-Allow-Methods: DELETE');

        }
        if($specialMethod == "put"){
            header('Access-Control-Allow-Methods: PUT');

        }

       echo json_encode($responseToClient);


}




}