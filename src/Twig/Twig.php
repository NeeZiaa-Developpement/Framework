<?php
namespace NeeZiaa\Twig;

use NeeZiaa\App;
use NeeZiaa\Utils\Config;
use NeeZiaa\Utils\Init;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Twig {

    private Environment $twig;
    private static $_instance;

    /**
     * @return mixed
     */
    public static function getInstance(): mixed
    {
        if(is_null(self::$_instance)) new Twig();
        return self::$_instance;
    }

    public function __construct(?array $extensions = null)
    {

        $app = App::getInstance();

        $loader = new FilesystemLoader(dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'Views');

        if ($app->getSettings()->get('DEBUG')) {
            $options = [];
        }  else {
            $options = [
                'cache' => $app->getSettings()->get('CACHE_PATH')
            ];
        }

        $twig = new Environment($loader, $options);

        if(!is_null($extensions)) {
            foreach ($extensions['functions'] as $fu){
                $fu['name'] = '\NeeZiaa\Twig\\'. ucfirst($fu['name']) . 'Extension';
                $twig->addFunction(
                    (new $fu['name']())
                        ->getFunctions()
                );
            }
            foreach ($extensions['filters'] as $fi){
                $fi['name'] = '\NeeZiaa\Twig\\'. ucfirst($fi['name']) . 'Extension';
                $twig->addFunction(
                    (new $fi['name']())
                        ->getFilters()
                );
            }
        }

        $this->twig = $twig;
    }

    public function render(string $filename, ?array $array_loader = NULL, ?array $twig = null): Environment
    {

        $twig_array = [];

        if (!is_null($array_loader)) {
            $twig_array = array_merge($twig_array, $array_loader);
        }

        echo $this->twig->render($filename . '.html.twig', $twig_array);

        return $this->twig;

    }

}