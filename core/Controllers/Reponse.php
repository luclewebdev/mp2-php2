<?php

namespace Controllers;

class Reponse extends AbstractController
{

    protected $defaultModelName = \Models\Reponse::class;


    public function delete()
    {

        $request = $this->get('form',["id"=>"number"]);

        if(!$request){
            return $this->redirect();

        }

        $reponse = $this->defaultModel->find($request['id']);


        if($reponse){

            $idMessage = $reponse->getMessage_id();
            $this->defaultModel->delete($reponse);

            return $this->redirect(["type"=>"message","action"=>"show", "id"=>$idMessage]);

        }

        return $this->redirect();



    }

    public function new(){

        $request = $this->post('form',["message_id"=>"number", "content"=>"text"]);


        if(!$request){
            return $this->redirect();

        }
        $messageModel = new \Models\Message();
        $message = $messageModel->find($request['message_id']);

        if($message){
            $reponse = new $this->defaultModel();
            $reponse->setContent($request['content']);
            $reponse->setMessage($message);

            $this->defaultModel->save($reponse);

            return $this->redirect(["type"=>"message","action"=>"show", "id"=>$message->getId()]);

        }

    }

}