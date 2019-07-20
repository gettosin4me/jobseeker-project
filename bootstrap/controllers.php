<?php

$controllers = [
    'HomeController' => ['\App\Http\Controllers\HomeController', __DIR__ . '/../app/http/controllers/HomeController.php'],
    'UserController' => ['\App\Http\Controllers\UserController', __DIR__ . '/../app/http/controllers/UserController.php'],
    'AdminController' => ['\App\Http\Controllers\AdminController', __DIR__ . '/../app/http/controllers/AdminController.php'],
    'JobController' => ['\App\Http\Controllers\JobController', __DIR__ . '/../app/http/controllers/JobController.php'],
];

return $controllers;