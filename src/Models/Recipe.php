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
  protected ?int $ingredient_quantity;

  public function __construct(?int $id, ?string $title, ?string $description,  ?string $instruction, ?string $img_path, ?string $difficulty, ?int $time,  ?string $created_at, ?int $id_user, ?string $ingredient_name, ?int $ingredient_quantity)
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
  }

  public function addRecipe()
  {
    $pdo =  DataBase::getConnection();
    $sql = "INSERT INTO `recipes` (id, title, description, instructions, difficulty, time, created_at, id_user) VALUE (?,?,?,?,?,?,?,?)";
    $statement = $pdo->prepare($sql);
    return $statement->execute([$this->id, $this->title, $this->description, $this->instruction, $this->difficulty, $this->time, $this->created_at, $this->id_user,]);
  }

  public function getRecipeIdByTitle($title, $description)
  {
    $pdo =  DataBase::getConnection();
    $sql = "SELECT * FROM `recipes` WHERE title = ? AND `description` = ?";
    $statement = $pdo->prepare($sql);
    $statement->execute([$title, $description]);
    $recipe = $statement->fetch(PDO::FETCH_ASSOC);
    if ($recipe) {
      return new Recipe($recipe['id'], null, null, null, null, null, null, null, null, null, null);
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

  public function getId(): ?int
  {
    return $this->id;
  }
}
