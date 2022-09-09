<?php

namespace App;

class ORM
{

    public function getInsertOrUpdateParamsForPDO($entityInstance){

        $reflect = new \ReflectionClass($entityInstance);

        $reflectedId = new \ReflectionProperty(get_class($entityInstance),'id');
        $exists = $reflectedId->isInitialized($entityInstance);

        $props = $reflect->getProperties(\ReflectionProperty::IS_PRIVATE);


        $filteredProps = [];

        foreach ($props as $prop){

            $filteredProps[]= $prop->getName();
        }

            unset($filteredProps[array_search("id",$filteredProps)]);

            $toExecute = [];

            if(!$exists){
                //insert case

                $fields = "";
                $values = "";

                foreach ($filteredProps as $prop){

                    $fields = $fields.$prop;
                    $values = $values.":".$prop;

                    $getter = "get".ucfirst($prop);

                    $toExecute[$prop]=$entityInstance->$getter();

                }
                    $paramsForPDO = [
                        "queryParams"=>"(".$fields.") VALUES (".$values.")",
                        "toExecute"=>$toExecute
                    ];


            }else{
                //  update case

                $query = "";

                foreach($filteredProps as $prop){

                    $query = $query.$prop."=:".$prop.",";
                    $getter = "get".ucfirst($prop);
                    $toExecute[$prop]= $entityInstance->$getter();


                }
               // $truc = "UPDATE FROM messages SET content=:content,intro=:intro,"; la virgule est embettante

                $query = substr($query, 0, -1);

                $toExecute['id']=$entityInstance->getId();

                $paramsForPDO = [
                    "queryParams"=>$query,
                    "toExecute"=>$toExecute
                ];
            }


            $paramsForPDO['exists'] = $exists;


        // exists bool
        //queryparams   request string

        //toExecute = associative array [values for pdo tags]


        return $paramsForPDO;
    }


}