<?php

namespace NeeZiaa;

use NeeZiaa\App;
use NeeZiaa\Twig\Twig;

class Controller {

    protected ?App $app = null;
    protected ?Twig $twig = null;

    public function __construct($params) {
        $this->app = App::getInstance();
        $this->twig = App::getInstance()->getTwig();
    }

}