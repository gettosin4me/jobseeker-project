<?php

namespace Jobseeker\Bin;

use Doctrine\ORM\EntityManager;

class Dependency {

    public function controller($app) 
    {
        $container = $app->getContainer();
        $container['upload_directory'] = __DIR__ . '/../public/uploads';
        $controllers = require_once __DIR__ . '/../bootstrap/controllers.php';
        foreach ($controllers as $key => $value) {
            if (!is_array($value)) {
                throw new \Exception("value must be an array");
            } else {
                $container[$key] = function($container) use ($value) {
                    // $view = $container->get("view"); // retrieve the 'view' from the container
                    // $db = $container->get('db');
                    // $validator = $container->get('validator');
                    require_once $value[1];
                    return new $value[0]($container);
                };
            }
        }
        
    }

    public function view($app) 
    {
        // Get container
        $container = $app->getContainer();

        // Register component on container
        $container['view'] = function ($container) {
            $view = new \Slim\Views\Twig(__DIR__ . '/../resources/views', [
                // 'cache' => __DIR__ . '/../../storage/cache/views'
                'cache' => false
            ]);

            $view->addExtension(
                new \Awurth\SlimValidation\ValidatorExtension($container['validator'])
            );

            $view->addExtension(new \Knlv\Slim\Views\TwigMessages($container['flash']));

            // Instantiate and add Slim specific extension
            $router = $container->get('router');
            $uri = \Slim\Http\Uri::createFromEnvironment(new \Slim\Http\Environment($_SERVER));
            $view->addExtension(new \Slim\Views\TwigExtension($router, $uri));

            return $view;
        };
    }

    public function validator($app)
    {
        $container = $app->getContainer();

        $container['validator'] = function () {
            return new \Awurth\SlimValidation\Validator();
        };
    }

    public function setEnvironment($app)
    {
        $container = $app->getContainer();

        $container['environment'] = function () {
            // Fix the Slim 3 subdirectory issue (#1529)
            // This fix makes it possible to run the app from localhost/slim3-app
            $scriptName = $_SERVER['SCRIPT_NAME'];
            $_SERVER['REAL_SCRIPT_NAME'] = $scriptName;
            $_SERVER['SCRIPT_NAME'] = dirname(dirname($scriptName)) . '/' . basename($scriptName);
            return new \Slim\Http\Environment($_SERVER);
        };
    }

    public function database($app)
    {
        $container = $app->getContainer();

        $container['db'] = function ($container) {
            $capsule = new \Illuminate\Database\Capsule\Manager;
            $dbConfig = dbConf();
            
            $capsule->addConnection($dbConfig['eloquent_connection']);

            $capsule->setAsGlobal();
            $capsule->bootEloquent();

            return $capsule;
        };
    }

    public function flash($app) 
    {
        // Fetch DI Container
        $container = $app->getContainer();

        // Register provider
        $container['flash'] = function () {
            return new \Slim\Flash\Messages();
        };

        return $app;
    }

    public function session($app) 
    {
        $container = $app->getContainer();

        // Register globally to app
        $container['session'] = function ($c) {
            return new \SlimSession\Helper;
        };

        return $app;
    }

    public function repository($container)
    {
        $container[\Jobseeker\App\Repository\UserRepository::class] = function ($container) {
            return new \Jobseeker\App\Repository\UserRepository($container[EntityManager::class]);
        };
    }
}
