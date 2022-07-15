<?php

namespace App\Controller;

use NeeZiaa\Utils\Init;
use App\Models\ExampleModel;

class HomeController
{

    private ExampleModel $model;

    private array $params;

    public function __construct($params)
    {
        // URL params
        $this->params = $params;

        $this->model = new ExampleModel();
    }

    public function index(): array|null|\Twig\Environment
    {
        return Init::render('index');
    }

}