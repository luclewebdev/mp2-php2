<?php

namespace Models;

class Reponse extends AbstractModel implements \JsonSerializable
{



    protected $tableName = "reponses";

    private int $id;
    private string $content;
    private int $message_id;

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

    /**
     * @return int
     */
    public function getMessage_id(): int
    {
        return $this->message_id;
    }

    /**
     * @param int $message_id
     */
    public function setMessageId(int $message_id): void
    {
        $this->message_id = $message_id;
    }

    public function setMessage(Message $message){
        $this->message_id = $message->getId();

    }


    /**
     * @param Message $message
     *
     */
    public function findAllByMessage(Message $message)
    {
            $sql = $this->pdo->prepare("SELECT * FROM {$this->tableName} WHERE message_id = :message_id");

            $sql->execute(["message_id"=>$message->getId()]);

            $reponses = $sql->fetchAll(\PDO::FETCH_CLASS, get_class($this));

            return $reponses;
    }

    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
        return [
          "id"=>$this->id,
          "content"=>$this->content
        ];
        // TODO: Implement jsonSerialize() method.
    }
}