<?php

namespace Database;

class PdoMySQL
{

    public static $currentPdo = null;


    /**
     * @return \PDO
     *
     * ici je peux taper de la docu humaine
     *
     */
    public static function getPdo() :\PDO      //Singleton
    {
        if(self::$currentPdo === null){

            self::$currentPdo = new \PDO("mysql:host=localhost;dbname=messagerie;charset=utf8", "jeanluc", "Jeanluc*22",[
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ
            ]);
        }



        return self::$currentPdo;

    }
}