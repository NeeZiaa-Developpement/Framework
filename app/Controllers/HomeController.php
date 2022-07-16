<?php

namespace App\Controller;

use NeeZiaa\App;
use NeeZiaa\Controller;
use NeeZiaa\Form\Form;
use NeeZiaa\Utils\Init;
use App\Models\ExampleModel;

class HomeController extends Controller
{

    private ExampleModel $model;

    private array $params;

    public function __construct()
    {

        $this->model = new ExampleModel();
    }

    public function index(): array|null|\Twig\Environment
    {
        (new Form())
            ->select('Example')
            ->option('Option 1 ', 1)
            ->option('Option 2 ', 2)

            ->input('Name')
            ->submit();
        return null;
//        return  $this->app->getTwig()->render('index');
    }

}