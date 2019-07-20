<?php

/**
 * Autoload file
 */
require __DIR__.'/../bootstrap/autoload.php';

/**
 * App loader file
 */

require_once __DIR__ . '/../config/database.php';
$app = require __DIR__.'/../bootstrap/app.php';
$container = require __DIR__.'/../bootstrap/database.php';
// $app = require __DIR__.'/../bootstrap/view.php';

require __DIR__.'/../app/providers/Factory.php';
require __DIR__.'/../app/routes/app.php';

// load_variable($app);

$factory = new \Jobseeker\App\Providers\Factory();

$factory->database($app);
$factory->controller($app);
$factory->repository($container);
$factory->flash($app);
$factory->view($app);

//Load routes
routes($app);

$app->run();