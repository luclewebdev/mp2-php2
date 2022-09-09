<?php


namespace Models;





class Message extends AbstractModel
{

 protected $tableName = "messages";

    private int $id;

    private string $content;


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function save(Message $message)
    {



        $requete = $this->pdo->prepare("INSERT INTO {$this->tableName} (content) VALUES (:content)");

        $requete->execute([
            "content"=> $message->getContent()
        ]);
        $idMessage = $this->pdo->lastInsertId();

        return $idMessage;
    }

    public function edit(Message $message ){




        $requete = $this->pdo->prepare("UPDATE {$this->tableName} SET content = :content WHERE id = :message_id");

        $requete->execute([
            "content"=> $message->getContent(),
            "message_id" => $message->getId()
            ]);
    }
}