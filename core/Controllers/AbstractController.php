<?php

namespace Controllers;



class AbstractController
{

    protected $defaultModel;

    protected $defaultModelName;

    public function __construct()
    {
        $this->defaultModel = new $this->defaultModelName();
    }

    public function redirect(?array $params = null)
    {
        return \App\Response::redirect($params);
    }

    public function render(string $nomDeTemplate, array $donneesDeLaPage)
    {
        return \App\View::render($nomDeTemplate, $donneesDeLaPage);

    }

    public function json($responseToClient, ? string $specialMethod = null)
    {
        return \App\Response::json($responseToClient, $specialMethod);

    }

    public function get(string $dataType, array $requestBodyParams)
    {
        return \App\Request::get($dataType, $requestBodyParams);
    }
    public function post(string $dataType, array $requestBodyParams)
    {
        return \App\Request::post($dataType, $requestBodyParams);
    }


}