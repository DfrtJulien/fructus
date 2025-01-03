<?php

namespace App\Controllers;

use App\Utils\AbstractController;
use App\Models\Recipe;
use App\Models\Comment;

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



    $id_user = htmlspecialchars($_SESSION['user']['id_user']);

    $idLikedRecipes = [];

    foreach ($allRecipes as $recipe) {
      $id_recipe = $recipe->getId();
      $recipe = new Recipe($id_recipe, null, null, null, null, null, null, null, $id_user, null, null);
      $isLiked = $recipe->isLikedAllRecipe();
      if ($isLiked) {
        $idLikedRecipes[] = $id_recipe;
      }
    }
    $count = count($idLikedRecipes);

    require_once(__DIR__ . "/../Views/recipe/showAllRecipes.view.php");
  }

  public function showRecipe()
  {
    if (isset($_GET['id_recipe'])) {

      $id_recipe = htmlspecialchars($_GET['id_recipe']);
      $id_user = htmlspecialchars($_SESSION['user']['id_user']);
      $recipe = new Recipe($id_recipe, null, null, null, null, null, null, null, $id_user, null, null);

      $newComment = new Comment(null, null, null, null, null, null, $id_recipe);
      $comment = $newComment->getNumberComment();

      $numberComments = $comment["COUNT(content)"];
      $sumNote = $newComment->sumArticleNote();
      $sumNoteInt = intval(reset($sumNote));

      $myRecipe = $recipe->getRecipeByid();
      $myIngredient = $recipe->getIngredientByRecipeId();

      $isLiked = $recipe->isLiked();
      if ($isLiked) {
        if (isset($_POST['id_recipe'], $_SESSION['user']['id_user'])) {

          $id_recipe = htmlspecialchars($_POST['id_recipe']);
          $recipe->removeFromFavorite();
          header("Refresh:0");
        }
      } else {
        if (isset($_POST['id_recipe'], $_SESSION['user']['id_user'])) {

          $id_recipe = htmlspecialchars($_POST['id_recipe']);
          $recipe->addToFavorite();
          header("Refresh:0");
        }
      }

      require_once(__DIR__ . '/../Views/recipe/showRecipe.view.php');
    } else {
      $this->redirectToRoute('/error404');
    }
  }

  public function showLikedRecipe()
  {
    if (isset($_SESSION['user'])) {

      $id_user = $_SESSION['user']['id_user'];

      $recipe = new Recipe(null, null, null, null, null, null, null, null, $id_user, null, null);

      $favoriteRecipes = $recipe->showFavoriteRecipe();


      require_once(__DIR__ . "/../Views/recipe/likedRecipe.view.php");
    }
  }

  public function addComment()
  {
    if (isset($_SESSION['user'])) {
      if (isset($_GET['id_recipe'])) {

        $id_recipe = htmlspecialchars($_GET['id_recipe']);
        $id_user = htmlspecialchars($_SESSION['user']['id_user']);
        $recipe = new Recipe($id_recipe, null, null, null, null, null, null, null, $id_user, null, null);
        $myRecipe = $recipe->getRecipeByid();

        $newComment = new Comment(null, null, null, null, null, null, $id_recipe);
        $comment = $newComment->getNumberComment();

        $numberComments = $comment["COUNT(content)"];
        $sumNote = $newComment->sumArticleNote();
        $sumNoteInt = intval(reset($sumNote));
        if (isset($_POST['note'], $_POST['comment'])) {
          $this->check("note", $_POST['note']);
          $this->check("comment", $_POST['comment']);

          if (empty($this->arrayError)) {
            $rating = htmlspecialchars($_POST['note']);
            $comment = htmlspecialchars($_POST['comment']);
            $date =  Date('Y-m-d');

            $comment = new Comment(null, $comment, $rating, $date, null, $id_user, $id_recipe);

            $comment->addNoteAndcomment();
          }
        }
        require_once(__DIR__ . "/../Views/recipe/addComment.view.php");
      } else {
        $this->redirectToRoute('/404');
      }
    } else {
      $this->redirectToRoute('/login');
    }
  }
}
