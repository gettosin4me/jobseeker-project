<?php

function routes ($app) {
    $app->map(['GET', 'POST'], '/', 'HomeController:home')->setName('app:home');
    $app->map(['GET', 'POST'], '/login', 'HomeController:home')->setName('app:login');
    $app->map(['GET', 'POST'], '/create/account', 'HomeController:createAccount')->setName('account:create');
    $app->map(['GET'], '/logout', 'HomeController:logout')->setName('app:logout');
    $app->map(['GET', 'POST'], '/users/survey', 'UserController:survey')->setName('user:survey');
    $app->map(['GET', 'POST'], '/users/dashboard', 'UserController:dashboard')->setName('user:dashboard');
    $app->map(['GET', 'POST'], '/users/applications', 'UserController:applications')->setName('user:applications');
    $app->map(['GET', 'POST'], '/jobs/browse', 'JobController:browse')->setName('job:browse');
    $app->map(['GET', 'POST'], '/jobs/offers', 'JobController:offers')->setName('job:offers');
    $app->map(['GET', 'POST'], '/jobs/search', 'JobController:search')->setName('job:search');
    $app->map(['GET', 'POST'], '/jobs/add', 'JobController:create')->setName('job:create');
    $app->map(['GET', 'POST'], '/jobs/apply/{id}', 'JobController:apply')->setName('job:apply');
    $app->map(['GET', 'POST'], '/jobs/{job_id}/applications', 'JobController:applications')->setName('job:applications');
    $app->map(['GET', 'POST'], '/jobs/applications/{application_id}/update/{status}', 'JobController:application_update')->setName('job:application_update');

    return $app;
}
