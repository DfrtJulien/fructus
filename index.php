<?php
require "vendor/autoload.php";



use Config\Router;

$router = new Router();

//la page d'accueil
$router->addRoute('/', 'HomeController', 'index');

// page s'inscrire 
$router->addRoute('/register', 'UsersController', 'register');


$router->handleRequest();
