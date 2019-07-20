<?php

// bootstrap.php

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Cache\FilesystemCache;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\ORM\Tools\Setup;
use Slim\Container;

// $container = new Container(require __DIR__ . '/../config/database.php');

// $container[EntityManager::class] = function (Container $container): EntityManager {
//     $config = Setup::createAnnotationMetadataConfiguration(
//         $container['metadata_dirs'],
//         $container['dev_mode']
//     );

//     $config->setMetadataDriverImpl(
//         new AnnotationDriver(
//             new AnnotationReader,
//             $container['metadata_dirs']
//         )
//     );

//     $config->setMetadataCacheImpl(
//         new FilesystemCache(
//             $container['cache_dir']
//         )
//     );

//     return EntityManager::create(
//         $container['connection'],
//         $config
//     );
// };

// return $container;