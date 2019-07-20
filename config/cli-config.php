<?php

// cli-config.php

// use Doctrine\ORM\EntityManager;
// use Doctrine\ORM\Tools\Console\ConsoleRunner;
// use Slim\Container;

// /** @var Container $container */
// $container = require_once __DIR__ . '/../bootstrap/database.php';

// ConsoleRunner::run(
//     ConsoleRunner::createHelperSet($container[EntityManager::class])
// );

require 'vendor/autoload.php';
require_once __DIR__ . '/database.php';

use Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper;
use Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Console\Helper\HelperSet;

$paths = [__DIR__.'/app/models'];
$isDevMode = true;

$dbConfig = dbConf();

$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$entityManager = EntityManager::create($dbConfig['connection'], $config);

return new HelperSet([
    'em' => new EntityManagerHelper($entityManager),
    'db' => new ConnectionHelper($entityManager->getConnection()),
]);