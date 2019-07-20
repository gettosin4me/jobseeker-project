<?php

namespace App\Http\Controllers;

use Psr\Container\ContainerInterface;
use Respect\Validation\Validator as V;

class AdminController
{
    protected $view;
    protected $db;
    protected $validator;

    public function __construct(ContainerInterface $container) {
        $this->view = $container->get('view');
        $this->db = $container->get('db');
        $this->validator = $container->get('validator');
        $this->flash = $container->get('flash');
    }
}
    