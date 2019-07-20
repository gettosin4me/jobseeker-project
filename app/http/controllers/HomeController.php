<?php

namespace App\Http\Controllers;

use Psr\Container\ContainerInterface;
use Respect\Validation\Validator as V;
use Jobseeker\App\Models\User;

class HomeController
{
    protected $view;
    protected $db;
    protected $validator;
    protected $flash;
    protected $session;
    protected $router;

    public function __construct(ContainerInterface $container) {
        $this->view = $container->get('view');
        $this->db = $container->get('db');
        $this->validator = $container->get('validator');
        $this->flash = $container->get('flash');
        $this->session = $container->get('session');
        $this->router = $container->get('router');
    }
    
    public function home($request, $response, $args) 
    {
      if($request->isPost()) {
        $payload = $request->getParsedBody();
        $this->validator->validate($request, [
            'email' => V::notBlank()->email(),
            'password' => V::length(6, 25)
        ]);

        if(!$this->validator->isValid()) {
          return $response->withRedirect('/login');
        }

        $password = md5($payload['password']);
        
        $user = $this->db->table('users')->where('email', $payload['email'])->where('password', $password)->first();

        if (!$user) {
          $this->flash->addMessage('error', 'Invalid Credentials');
          return $response->withRedirect('/');
        }

        $this->session->set('user', $user);

        if ($user->step_completed == 1) {
            $this->flash->addMessage('success', 'Welcome Back, Please take the survey');
            return $response->withRedirect($this->router->pathFor('user:survey'));
        }

        if ($user->step_completed == 2) {
          $this->flash->addMessage('success', 'Welcome Back, ' . $user->first_name);
          return $response->withRedirect($this->router->pathFor('user:dashboard'));
      }
        // print_r($user);exit;
        
      }
      
      return $this->view->render($response, 'frontend/app/home.html');
    }

    public function createAccount($request, $response, $args)
    {
      // print_r($this->flash->getMessages()); exit;
      if($request->isPost()) {

        $payload = $request->getParsedBody();

        $this->validator->validate($request, [
            'first_name' => V::alnum('_')->noWhitespace(),
            'middle_name' => V::alnum('_')->noWhitespace(),
            'last_name' => V::alnum('_')->noWhitespace(),
            'email' => V::notBlank()->email(),
            'password' => V::length(6, 25),
            'date_of_birth' => V::notBlank(),
            'course_of_study' => V::notBlank(),
            'highest_qualification' => V::notBlank(),
            'address' => V::notBlank(),
            'state_of_origin' => V::notBlank(),
            'lga' => V::notBlank(),
            'mobile_number' => V::notBlank()->numeric(),
            'gender' => V::notBlank()
        ]);
        
        if(!$this->validator->isValid()) {
          return $response->withRedirect('/create/account');
        }

        $password = ['password' => md5($payload['password'])];

        $this->db->table('users')->insert(array_merge($payload, $password));

        $this->flash->addMessage('success', 'Account created successfully');
        return $response->withRedirect('/');
        
      }

      return $this->view->render($response, 'frontend/app/signup.html');
    }

    public function logout($request, $response, $args)
    {
        if(!$this->session->user) {
          $this->flash->addMessage('success', 'Successfully logged out');
          return $response->withRedirect('/');
        }

        $this->session->delete('user');
        $this->flash->addMessage('success', 'Successfully logged out');
        return $response->withRedirect('/');
    }
}