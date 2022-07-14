<?php

namespace NeeZiaa\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

use NeeZiaa\Router\Router;

class UrlExtension extends AbstractExtension
{

    public function getFunctions(): TwigFunction
    {
        return new \Twig\TwigFunction('url', array($this, 'url'));
    }

    public function url($route, $params)
    {

        return (new \NeeZiaa\Router\Router($_SERVER['REQUEST_URI']))->url($route, $params);

    }

}