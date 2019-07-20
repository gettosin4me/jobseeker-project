<?php

function load_variable($app) {
    $twig = new Twig_Environment($app);
    $twig->addGlobal('myStuff', 'tosin');
}