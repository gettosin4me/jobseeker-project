<?php

if(!defined('APP_ROOT')) {
    define('APP_ROOT', __DIR__);
}

if(!function_exists('boot')) {
    function boot() {
        $dotenv = Dotenv\Dotenv::create(__DIR__ . '/../');
        $dotenv->load();
        
        $dbConf = dbConf();
    
        // Create and configure Slim app
        $config = [
            'settings' => [
                'addContentLengthHeader' => false,
                'displayErrorDetails' => true,
                'doctrine' => $dbConf,
                'db' => $dbConf['eloquent_connection'],
                'logger' => [
                    'name' => 'jobseeker-app',
                    'level' => Monolog\Logger::DEBUG,
                    'path' => __DIR__ . '/../logs/app.log',
                ],
            ],
            'templates.path' => '../resources/views',
        ];
    
        $app = new \Slim\App($config);
    
        return $app;
    }
}