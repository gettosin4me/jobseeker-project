<?php

namespace App\Http\Controllers;


use Jobseeker\App\Models\User;
use Jobseeker\App\Models\Job;
use Jobseeker\App\Models\Application;

use Psr\Container\ContainerInterface;
use Respect\Validation\Validator as V;

class UserController
{
    protected $view;
    protected $db;
    protected $validator;
    protected $session;
    protected $flash;
    protected $router;

    public function __construct(ContainerInterface $container) {
        $this->view = $container->get('view');
        $this->db = $container->get('db');
        $this->validator = $container->get('validator');
        $this->flash = $container->get('flash');
        $this->session = $container->get('session');
        $this->router = $container->get('router');
    }

    public function survey($request, $response, $args)
    {
        $user = $this->session->user;

        if ($user->step_completed == 2) {
            $this->flash->addMessage('success', 'Welcome Back, ' . $user->first_name);
            return $response->withRedirect($this->router->pathFor('user:applications'));
        }

        if($request->isPost()) {
            $userModel = User::find($user->id);
            $userModel->update([
                'survey_total' => array_sum(array_values($request->getParsedBody())),
                'step_completed' => 2
            ]);

            $user = $this->db->table('users')->where('id', $user->id)->first();
            $user = $this->session->set('user', $user);

            $this->flash->addMessage('success', 'Thank you for completing our survey, ' . $user->first_name);
            return $response->withRedirect($this->router->pathFor('user:applications'));
        }

        return $this->view->render($response, 'frontend/user/survey.html', [
            'user' => $user
        ]);
    }

    public function applications($request, $response, $args)
    {
        $user = $this->session->user;
        
        if($user->step_completed == 1) {
            $this->flash->addMessage('error', 'Please, take the survey before you can access dashboard');

            return $response->withRedirect($this->router->pathFor('user:survey'));
        }

        $userModel = User::find($user->id);

        $jobs = $userModel->jobs;

        return $this->view->render($response, 'frontend/user/applications.html', [
            'user' => $user,
            'jobs' => $jobs,
        ]);
    }

    public function dashboard($request, $response, $args)
    {
        $user = $this->session->user;
        
        if($user->step_completed == 1) {
            $this->flash->addMessage('error', 'Please, take the survey before you can access dashboard');

            return $response->withRedirect($this->router->pathFor('user:survey'));
        }

        return $this->view->render($response, 'frontend/user/dashboard.html', [
            'user' => $user
        ]);
    }
    
}