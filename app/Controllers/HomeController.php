<?php

namespace App\Controller;

use NeeZiaa\App;
use NeeZiaa\Controller;
use NeeZiaa\Utils\Init;
use App\Models\ExampleModel;

class HomeController extends Controller
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
        return  $this->app->render('index');
    }

}