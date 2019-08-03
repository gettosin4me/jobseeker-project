<?php

/**
 * Autoload file
 */
require __DIR__.'/../bootstrap/autoload.php';

/**
 * App loader file
 */
require_once __DIR__ . '/../config/database.php';
require __DIR__.'/../bootstrap/app.php';
require __DIR__.'/../bootstrap/models.php';

$app = boot();
// $app = require __DIR__.'/../bootstrap/view.php';

require __DIR__.'/../bin/Dependency.php';
require __DIR__.'/../app/routes/app.php';