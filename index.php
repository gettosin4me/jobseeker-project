<?php

// Start PHP session
session_start(); //by default requires session storage

if (PHP_SAPI == 'cli-server') {
    $_SERVER['SCRIPT_NAME'] = basename(__FILE__);
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url  = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}

require __DIR__.'/bin/load.php';

$factory = new \Jobseeker\Bin\Dependency();

$app->add(new \Slim\Middleware\Session([
    'name' => 'jobseeker_session',
    'autorefresh' => true,
    'lifetime' => '1 hour'
]));

$factory->setEnvironment($app);
$factory->flash($app);
$factory->validator($app);
$factory->session($app);
$factory->database($app);
$factory->controller($app);
$factory->view($app);

$assetUrlFunction = new \Twig_SimpleFunction('assetUrl', function($path) {
    return '/public/' . $path;
});
  
$app->getContainer()['view']->getEnvironment()->addFunction($assetUrlFunction);

//Load routes
routes($app);

$app->run();