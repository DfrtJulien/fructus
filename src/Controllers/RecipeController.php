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
          $title = $_POST['title'];
          $description = $_POST['description'];
          $recipe = $_POST['recipe'];
          $time = $_POST['time'];
          $dificulty = $_POST['dificulty'];
          $created_at = date("Y-m-d");
          $id_user = $_SESSION['user']["id_user"];

          $recipe = new Recipe(null, $title, $description, $recipe, null, $dificulty, $time, $created_at, $id_user, null, null);
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
        }
        require_once(__DIR__ . '/../Views/recipe/addRecipe.view.php');
      }
    }
  }
}
