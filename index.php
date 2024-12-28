<?php
require "vendor/autoload.php";
session_start();


use Config\Router;

$router = new Router();

//la page d'accueil
$router->addRoute('/', 'HomeController', 'index');

// page s'inscrire 
$router->addRoute('/register', 'UsersController', 'register');
// page connexion
$router->addRoute('/login', 'UsersController', 'login');

$router->handleRequest();
