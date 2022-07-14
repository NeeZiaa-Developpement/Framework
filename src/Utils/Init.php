<?php
namespace NeeZiaa\Utils;

use JetBrains\PhpStorm\NoReturn;
use NeeZiaa\Database\QueryBuilder;
use NeeZiaa\Router\Router;
use NeeZiaa\Router\Routes;
use NeeZiaa\Utils\Main;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Init
{

    public static function Twig(array $functions = [], array $filters = []): Environment
    {

        $functions = [
            ['name'=>'url'],
        ];

        $loader = new FilesystemLoader(dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'Views');

        if (Main::env()['DEBUG']) $options = []; else $options = ['cache' => Main::env()['CACHE_PATH']];

        //        foreach ($functions as $fu){
//            $fu['name'] = '\NeeZiaa\Twig\\'. ucfirst($fu['name']) . 'Extension';
//            $twig->addFunction(
//                (new $fu['name']())
//                    ->getFunctions()
//            );
//        }
//        foreach ($filters as $fi){
//            $fi['name'] = '\NeeZiaa\Twig\\'. ucfirst($fi['name']) . 'Extension';
//            $twig->addFunction(
//                (new $fi['name']())
//                    ->getFilters()
//            );
//        }
//        require_once dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'Routes.php';
//        $function = new \Twig\TwigFunction('url', function ($route, $params = []){
//            Routes::$router->url($route, $params);
//        });
//        $twig->addFunction($function);
        return new Environment($loader, $options);
    }

    public static function render(string $filename, ?array $array_loader = NULL, ?array $twig = null): Environment|array|null
    {
        if (is_null($twig)) {
            $twig = Init::Twig();
        }

        $settings = (new QueryBuilder())
            ->select()
            ->table('settings')
            ->fetch();

        $twig_array = [
            'settings' => array_map('utf8_encode', $settings)
        ];

        if (!is_null($array_loader)) {
            $twig_array = array_merge($twig_array, $array_loader);
        }

        echo $twig->render($filename . '.html.twig', $twig_array);

        return $twig;

    }

}