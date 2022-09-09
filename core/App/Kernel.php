<?php

namespace App;

class Kernel
{

    public static function run(){


        $type = "message";
        $action = "index";


        if(!empty($_GET['type'])){ $type = $_GET['type']; }
        if(!empty($_GET['action'])){ $action = $_GET['action']; }



        $type = ucfirst($type);

        $typeName = "\Controllers\\".$type;

        $controller = new $typeName();

        $controller->$action();
    }



}