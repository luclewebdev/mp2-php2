<?php

namespace App;

class Request
{
// get() post() put() delete()

public static function get(string $dataType, array $requestBodyParams){

    if( $_SERVER['REQUEST_METHOD'] != 'GET' ){
        return false;
    }

    return Request::isSubmitted($dataType, $requestBodyParams, 'get');

}
    public static function post(string $dataType, array $requestBodyParams){

        if( $_SERVER['REQUEST_METHOD'] != 'POST' ){
            return false;
        }

        return Request::isSubmitted($dataType, $requestBodyParams);

    }
    public static function put(string $dataType, array $requestBodyParams){

        if( $_SERVER['REQUEST_METHOD'] != 'PUT' ){
            return false;
        }

        return Request::isSubmitted($dataType, $requestBodyParams);

    }
    public static function delete(string $dataType, array $requestBodyParams){

        if( $_SERVER['REQUEST_METHOD'] != 'DELETE' ){
            return false;
        }

        return Request::isSubmitted($dataType, $requestBodyParams);

    }


// isSubmitted( datatype, requestBodyParams)

    // aller recuperer dans $_GET ou dans $_POST le corps de la requete soumise


    //analyse chaque element de la requete


    // filtrer chaque element (injection sql etc)

    //si un element est du type voulu (int, string etc) et qu'il passe les filtres d'injection SQL avec succes

    //alors il sera ajouté a un tableau associatif qui sera renvoyé au controlleur pour envoyer dans la DB



    public static function isSubmitted(string $dataType, array $requestBodyParams, string $get = null)
    {
        if($dataType == "json"){

            $requestBody = file_get_contents('php://input');

            $requestParams = json_decode($requestBody, true);
            }



        if($dataType == "form"){

            if($get == 'get'){
                $requestParams = $_GET;
            }else{

                $requestParams = $_POST;

            }

        }

        $results = [];

            foreach ($requestBodyParams as $param => $paramDataType)
            {
                    if(!empty($requestParams[$param])){

                        if($paramDataType == 'text'){

                            $results[$param] = htmlspecialchars($requestParams[$param]);

                        }else if($paramDataType == 'number'){

                                if(ctype_digit($requestParams[$param])){

                                    $number = htmlspecialchars($requestParams[$param]);
                                    $results[$param] = (int)$number;

                                }else{return false;}

                        }





                    }else{return false;}

            }

        if($results === [])return false;
        return $results; // uniquement un tableau valide de parametres a enregistrer dans la DB
    }


}