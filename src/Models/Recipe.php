<?php

namespace App\Models;

use PDO;
use Config\DataBase;

class Recipe
{
  protected ?int $id;
  protected ?string $title;
  protected ?string $description;
  protected ?string $instruction;
  protected ?string $img_path;
  protected ?string $difficulty;
  protected ?int $time;
  protected ?string $created_at;
  protected ?int $id_user;
  protected ?string $ingredient_name;
  protected int|string|null $ingredient_quantity;
  protected ?string $category;

  public function __construct(?int $id, ?string $title, ?string $description,  ?string $instruction, ?string $img_path, ?string $difficulty, ?int $time,  ?string $created_at, ?int $id_user, ?string $ingredient_name, int|string|null $ingredient_quantity, ?string $category)
  {
    $this->id = $id;
    $this->title = $title;
    $this->description = $description;
    $this->instruction = $instruction;
    $this->img_path = $img_path;
    $this->difficulty = $difficulty;
    $this->time = $time;
    $this->created_at = $created_at;
    $this->id_user = $id_user;
    $this->ingredient_name = $ingredient_name;
    $this->ingredient_quantity = $ingredient_quantity;
    $this->category = $category;
  }

  public function addRecipe()
  {
    $pdo =  DataBase::getConnection();
    $sql = "INSERT INTO `recipes` (id, title, description, instructions, img_path, difficulty, time, created_at, id_user) VALUE (?,?,?,?,?,?,?,?,?)";
    $statement = $pdo->prepare($sql);
    return $statement->execute([$this->id, $this->title, $this->description, $this->instruction, $this->img_path, $this->difficulty, $this->time, $this->created_at, $this->id_user,]);
  }

  public function getRecipeIdByTitle($title, $description)
  {
    $pdo =  DataBase::getConnection();
    $sql = "SELECT * FROM `recipes` WHERE title = ? AND `description` = ?";
    $statement = $pdo->prepare($sql);
    $statement->execute([$title, $description]);
    $recipe = $statement->fetch(PDO::FETCH_ASSOC);
    if ($recipe) {
      return new Recipe($recipe['id'], null, null, null, null, null, null, null, null, null, null, null);
    } else {
      return null;
    }
  }

  public function addIngredient()
  {
    $pdo =  DataBase::getConnection();
    $sql = "INSERT INTO `ingredients` (name, quantity, id_recipe) VALUE (?,?,?)";
    $statement = $pdo->prepare($sql);
    return $statement->execute([$this->ingredient_name, $this->ingredient_quantity, $this->id,]);
  }

  public function addCategory()
  {
    $pdo =  DataBase::getConnection();
    $sql = "INSERT INTO `category` (category, id_recipe) VALUE (?,?)";
    $statement = $pdo->prepare($sql);
    return $statement->execute([$this->category, $this->id]);
  }

  public function getAllRecipes()
  {
    $pdo =  DataBase::getConnection();
    $sql = "SELECT * FROM recipes WHERE created_at < (SELECT created_at FROM recipes ORDER BY created_at DESC LIMIT 1 OFFSET 2);";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $fetchedRecipes = $statement->fetchAll(PDO::FETCH_ASSOC);
    $recipes = [];
    if ($fetchedRecipes) {
      foreach ($fetchedRecipes as $recipe) {
        $recipes[] = new Recipe($recipe['id'], $recipe['title'], null, null, $recipe['img_path'], null, null, null, null, null, null, null);
      }
      return $recipes;
    } else {
      return null;
    }
  }

  public function getThreeMostRecentRecipe()
  {
    $pdo =  DataBase::getConnection();
    $sql = "SELECT * FROM recipes ORDER BY created_at DESC LIMIT 3";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $fetchedRecipes = $statement->fetchAll(PDO::FETCH_ASSOC);
    $recipes = [];
    if ($fetchedRecipes) {
      foreach ($fetchedRecipes as $recipe) {
        $recipes[] = new Recipe($recipe['id'], $recipe['title'], null, null, $recipe['img_path'], null, null, null, null, null, null, null);
      }
      return $recipes;
    } else {
      return null;
    }
  }

  public function getRecipeByid()
  {
    $pdo =  DataBase::getConnection();
    $sql = "SELECT * FROM `recipes` WHERE id = ?";
    $statement = $pdo->prepare($sql);
    $statement->execute([$this->id]);
    $recipe = $statement->fetch(PDO::FETCH_ASSOC);

    if ($recipe) {
      return new Recipe($recipe['id'], $recipe['title'], $recipe['description'], $recipe['instructions'], $recipe['img_path'], $recipe['difficulty'], $recipe['time'], null, null, null, null, null);
    } else {
      return null;
    }
  }

  public function getIngredientByRecipeId()
  {
    $pdo =  DataBase::getConnection();
    $sql = "SELECT * FROM `ingredients` WHERE id_recipe = ?";
    $statement = $pdo->prepare($sql);
    $statement->execute([$this->id]);
    $fetchedIngredient = $statement->fetchAll(PDO::FETCH_ASSOC);
    $ingredients = [];
    if ($fetchedIngredient) {
      foreach ($fetchedIngredient as $ingredient) {
        $ingredients[] = new Recipe(null, null, null, null, null, null, null, null, null, $ingredient['name'], $ingredient['quantity'], null);
      }
      return $ingredients;
    } else {
      return null;
    }
  }

  public function addToFavorite()
  {
    $pdo =  DataBase::getConnection();
    $sql = "INSERT INTO `likes` (id_user, id_recipe) VALUES (?,?)";
    $statement = $pdo->prepare($sql);
    return $statement->execute([$this->id_user, $this->id]);
  }

  public function isLiked()
  {
    $pdo =  DataBase::getConnection();
    $sql =  "SELECT * FROM `likes` WHERE id_user = ? AND id_recipe = ?";
    $statement = $pdo->prepare($sql);
    $statement->execute([$this->id_user, $this->id]);
    return $statement->fetch(PDO::FETCH_ASSOC);
  }

  public function isLikedAllRecipe()
  {
    $pdo =  DataBase::getConnection();
    $sql =  "SELECT * FROM `likes` WHERE id_user = ? AND id_recipe = ?";
    $statement = $pdo->prepare($sql);
    $statement->execute([$this->id_user, $this->id]);
    return $statement->fetchALL(PDO::FETCH_ASSOC);
  }

  public function removeFromFavorite()
  {
    $pdo =  DataBase::getConnection();
    $sql =  "DELETE  FROM `likes` WHERE id_user = ? AND id_recipe = ?";
    $statement = $pdo->prepare($sql);
    $statement->execute([$this->id_user, $this->id]);
    return $statement->fetch(PDO::FETCH_ASSOC);
  }

  public function showFavoriteRecipe()
  {
    $pdo =  DataBase::getConnection();
    $sql = "SELECT `recipes`.`id`, `recipes`.`title`, `recipes`.`img_path` FROM `recipes` LEFT JOIN `likes` ON `recipes`.`id` = `likes`.`id_recipe` WHERE `likes`.`id_user` = ?";
    $statement = $pdo->prepare($sql);
    $statement->execute([$this->id_user]);
    $fetchedRecipes = $statement->fetchAll(PDO::FETCH_ASSOC);
    $recipes = [];
    if ($fetchedRecipes) {
      foreach ($fetchedRecipes as $recipe) {
        $recipes[] = new Recipe($recipe['id'], $recipe['title'], null, null, $recipe['img_path'], null, null, null, null, null, null, null);
      }
      return $recipes;
    } else {
      return null;
    }
  }

  public function getId(): ?int
  {
    return $this->id;
  }

  public function getTitle(): ?string
  {
    return $this->title;
  }

  public function getDescription(): ?string
  {
    return $this->description;
  }

  public function getInstruction(): ?string
  {
    return $this->instruction;
  }

  public function getImg(): ?string
  {
    return $this->img_path;
  }

  public function getDifficulty(): ?string
  {
    return $this->difficulty;
  }

  public function getTime(): ?int
  {
    return $this->time;
  }

  public function getCreation_date(): ?string
  {
    return $this->created_at;
  }

  public function getId_user(): ?int
  {
    return $this->id_user;
  }

  public function getIngredient_name(): ?string
  {
    return $this->ingredient_name;
  }

  public function getIngredient_quantity(): string|int
  {
    return $this->ingredient_quantity;
  }
}
