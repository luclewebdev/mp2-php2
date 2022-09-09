<?php

namespace Controllers;





class Message extends AbstractController
{


    protected $defaultModelName = \Models\Message::class;


    public function index(){


        $messages = $this->defaultModel->findAll();

        return $this->render("message/index",[
            "pageTitle" => 'Accueil',
            "messages" => $messages
        ]);
    }


    public function show()
    {

        $request = $this->get("form", ["id"=>"number"]);

        $message = $this->defaultModel->find($request['id']);


        return $this->render("message/show",[
            "pageTitle" => "message n°{$message->getId()}",
            "message" => $message
        ]);

    }

    public function remove()
{


    $request = $this->get("form", ["id"=>"number"]);

    if(!$request){
        return $this->redirect();

    }


    $message = $this->defaultModel->find($request['id']);

    if($message){
        $this->defaultModel->delete($message);

    }



   return $this->redirect();


}


    public function new()
    {


        $request = $this->post("form",["content"=>"text"]);


        if($request){

            $message = new \Models\Message();
            $message->setContent($request['content']);

            $idMessage = $this->defaultModel->save($message);

            return $this->redirect(["type"=>"message",
                                    "action"=>"show",
                                    "id"=>$idMessage]);

        }



        return $this->render("message/create",[
            "pageTitle" => 'Nouveau message'
        ]);


    }

    public function change()
    {

      $request = $this->post("form", ["content"=>"text", "id"=>"number"]);


        if($request){

            $message = $this->defaultModel->find($request['id']);
            $message->setContent($request['content']);


            $this->defaultModel->save($message);


            return $this->redirect([
                "type"=>"message",
                "action"=>"show",
                "id"=>$message->getId()
            ]);


        }

        $requestForId = $this->get('form',['id'=>'number']);

        $message = $this->defaultModel->find($requestForId['id']);


        if(!$message || !$requestForId)
        {
            return $this->redirect();
        }

        return $this->render("message/edit",[
            "pageTitle" => "Editer le message n°{$message->getId()}",
            "message" => $message
        ]);

    }

}
