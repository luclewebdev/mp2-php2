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

        $id=$_GET['id'];

        $message = $this->defaultModel->find($id);


        return $this->render("message/show",[
            "pageTitle" => "message n°{$message->getId()}",
            "message" => $message
        ]);

    }

    public function remove()
{
                $id = null;

                if(
                    !empty($_GET['id'])
                    &&
                    ctype_digit($_GET['id'])

                ) {
                    $id=$_GET['id'];
                }

                if(!$id){
                    return $this->redirect();

                }




    $message = $this->defaultModel->find($id);

    if($message){
        $this->defaultModel->delete($message);

    }



   return $this->redirect();


}


    public function new()
    {
        $messageContent = null;

        if(!empty($_POST['content'])){


            $messageContent = htmlspecialchars($_POST['content']) ;
        }

        if($messageContent){

            $message = new \Models\Message();
            $message->setContent($messageContent);

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

        $id=$_GET['id'];




        $message = $this->defaultModel->find($id);


        if(!$message)
        {
            return $this->redirect();
        }

        $messageContent = null;

        if(!empty($_POST['content'])){


            $messageContent = htmlspecialchars($_POST['content']) ;
        }

        if($messageContent){

            $message->setContent($messageContent);


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
