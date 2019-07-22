<?php

// Start PHP session
session_start(); //by default requires session storage

/**
 * Autoload file
 */
require __DIR__.'/bootstrap/autoload.php';

/**
 * App loader file
 */
require_once __DIR__ . '/config/database.php';
require __DIR__.'/bootstrap/app.php';
require __DIR__.'/bootstrap/models.php';

$app = boot();
// $app = require __DIR__.'/../bootstrap/view.php';

require __DIR__.'/bin/Dependency.php';
require __DIR__.'/app/routes/app.php';

$factory = new \Jobseeker\Bin\Dependency();

$app->add(new \Slim\Middleware\Session([
    'name' => 'jobseeker_session',
    'autorefresh' => true,
    'lifetime' => '1 hour'
  ]));

$factory->flash($app);
$factory->session($app);
$factory->database($app);
$factory->controller($app);
$factory->validator($app);
$factory->view($app);

//Load routes
routes($app);

$app->run();