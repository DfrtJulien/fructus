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
// se déconecter
$router->addRoute('/logout', 'UsersController', 'logout');

//ajoutez une recette
$router->addRoute('/addRecipe', 'RecipeController', 'addRecipe');


$router->handleRequest();
