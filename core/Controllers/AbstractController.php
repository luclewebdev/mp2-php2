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




}