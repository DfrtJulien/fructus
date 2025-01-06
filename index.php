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

// voir toutes les recettes
$router->addRoute('/recipes', 'RecipeController', 'showAllRecipes');
// voir une recettes
$router->addRoute('/recipe', 'RecipeController', 'showRecipe');
// voir mes recettes aimer
$router->addRoute('/recipeLiked', 'RecipeController', 'showLikedRecipe');

// ajoutez une note et un commentaire a une recette
$router->addRoute('/addComment', 'RecipeController', 'addComment');
// modifier le commentaire
$router->addRoute('/editComment', 'RecipeController', 'editComment');
$router->addRoute('/deleteComment', 'RecipeController', 'deleteComment');

$router->handleRequest();
