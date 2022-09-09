<?php


namespace Models;






use App\ORM;

abstract class AbstractModel
{


    protected \PDO $pdo;

    protected $tableName;

    protected ORM $orm;

    public function __construct()
    {

        $this->pdo = \Database\PdoMySQL::getPdo();
        $this->orm = new ORM();

    }

    public function findAll(){





        $requete = $this->pdo->query("SELECT * FROM {$this->tableName}");

        $elements = $requete->fetchAll(\PDO::FETCH_CLASS, get_class($this));



        return $elements;
    }



    public function find(int $id){



        $requete = $this->pdo->prepare("SELECT * FROM {$this->tableName} WHERE id = :id");



        $requete->execute([
            "id"=>$id
        ]);

        $requete->setFetchMode(\PDO::FETCH_CLASS, get_class($this));

        $element = $requete->fetch();

        return $element;

    }

    public function delete(Object $object){

        $requeteSuppr = $this->pdo->prepare("DELETE FROM {$this->tableName} WHERE id = :id");

        $requeteSuppr->execute(["id"=>$object->getId()]);
    }

    public function save(Object $object){

        $params = $this->orm->getInsertOrUpdateParamsForPdo($object);

        if(!$params['exists']){
            //case insert
            $sql = $this->pdo->prepare("INSERT INTO {$this->tableName} {$params['queryParams']}");
        }else{
            //case update

            $sql = $this->pdo->prepare("UPDATE {$this->tableName} SET {$params['queryParams']} WHERE id=:id");


        }

        $sql->execute($params['toExecute']);
        return $this->pdo->lastInsertId();
    }



}