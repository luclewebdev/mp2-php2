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


     $id =   $_GET['id'];


        $message = $this->defaultModel->find($id);


        if(!$message || !$id)
        {
            return $this->redirect();
        }

      $request = $this->post("form", ["content"=>"text"]);


        if($request){

            $message->setContent($request['content']);


            $this->defaultModel->edit($message);


            return $this->redirect([
                "type"=>"message",
                "action"=>"show",
                "id"=>$message->getId()
            ]);


        }


        return $this->render("message/edit",[
            "pageTitle" => "Editer le message n°{$message->getId()}",
            "message" => $message
        ]);

    }

}
