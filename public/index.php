<?php

// Start PHP session
session_start(); //by default requires session storage

require __DIR__.'/../bin/load.php';

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