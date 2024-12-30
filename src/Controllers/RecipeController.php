<?php

namespace App\Controllers;

use App\Utils\AbstractController;
use App\Models\Recipe;

class RecipeController extends AbstractController
{

  public function addRecipe()
  {

    if ($_SESSION['user']["id_role"] == 1) { {
        if (isset($_POST['title'], $_POST['description'], $_POST['recipe'], $_POST['time'], $_POST['dificulty'])) {
          var_dump($_POST['recipe']);
        }
        require_once(__DIR__ . '/../Views/recipe/addRecipe.view.php');
      }
    }
  }
}
