<?php


namespace Models;





class Message extends AbstractModel implements \JsonSerializable
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

    public function getReponses()
    {

        $modelReponse = new \Models\Reponse();

        $reponses = $modelReponse->findAllByMessage($this);

        return $reponses;
    }

    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
        return [
            "id"=>$this->id,
            "content"=>$this->content,
            "reponses"=>$this->getReponses()
        ];

    }
}