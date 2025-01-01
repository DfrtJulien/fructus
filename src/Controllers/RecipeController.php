<?php

namespace App\Controllers;

use App\Utils\AbstractController;
use App\Models\Recipe;

class RecipeController extends AbstractController
{

  public function addRecipe()
  {

    if ($_SESSION['user']["id_role"] == 1) { {
        if (isset($_POST['title'], $_POST['description'],  $_POST['recipe'], $_POST['time'], $_POST['dificulty'])) {
          $title = htmlspecialchars($_POST['title']);
          $description = htmlspecialchars($_POST['description']);
          $recipe = htmlspecialchars($_POST['recipe']);
          $time = htmlspecialchars($_POST['time']);
          $dificulty = htmlspecialchars($_POST['dificulty']);
          $created_at = date("Y-m-d");
          $id_user = htmlspecialchars($_SESSION['user']["id_user"]);

          // chemin pour stocker les images
          $target_dir = "public/img/";
          $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

          if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

            $img = htmlspecialchars(basename($_FILES["fileToUpload"]["name"]));
            $img_path =  $img;


            $recipe = new Recipe(null, $title, $description, $recipe, $img_path, $dificulty, $time, $created_at, $id_user, null, null);
            $recipe->addRecipe();


            // je recupere l'id de la recette
            $recipeCreated = $recipe->getRecipeIdByTitle($title, $description);
            $recipeId = $recipeCreated->getId();


            $ingredientExist = $this->ingredientExist();
            $this->addIngredient($ingredientExist);
            $ingredient = $this->ingredients;


            foreach ($ingredient as $ingredient => $quantity) {
              $addIngredient = new Recipe($recipeId, null, null, null, null, null, null, null, null, $ingredient, $quantity);
              $addIngredient->addIngredient();
            }
          } else {
            $error = "L'image est trop volumineuse.";
          }
        }
        require_once(__DIR__ . '/../Views/recipe/addRecipe.view.php');
      }
    }
  }

  public function showAllRecipes()
  {

    $newRecipes = new Recipe(null, null, null, null, null, null, null, null, null, null, null);
    $allRecipes = $newRecipes->getAllRecipes();


    require_once(__DIR__ . "/../Views/recipe/showAllRecipes.view.php");
  }

  public function showRecipe()
  {
    if (isset($_GET['id_recipe'])) {

      $id_recipe = htmlspecialchars($_GET['id_recipe']);
      $recipe = new Recipe($id_recipe, null, null, null, null, null, null, null, null, null, null);
      $myRecipe = $recipe->getRecipeByid();
      $myIngredient = $recipe->getIngredientByRecipeId();


      require_once(__DIR__ . '/../Views/recipe/showRecipe.view.php');
    } else {
      $this->redirectToRoute('/error404');
    }
  }
}
