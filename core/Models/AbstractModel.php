<?php


namespace Models;






abstract class AbstractModel
{


    protected $pdo;

    protected $tableName;



    public function __construct()
    {

        $this->pdo = \Database\PdoMySQL::getPdo();

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

    public function delete(Message $message){




        $requeteSuppr = $this->pdo->prepare("DELETE FROM {$this->tableName} WHERE id = :id");

        $requeteSuppr->execute(["id"=>$message->getId()]);
    }


}