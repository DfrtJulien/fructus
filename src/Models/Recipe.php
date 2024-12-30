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
  protected ?string $name;
  protected ?int $quantity;

  public function __construct(?int $id, ?string $title, ?string $description,  ?string $instruction, ?string $img_path, ?string $difficulty, ?int $time,  ?string $created_at, ?int $id_user, ?string $name, ?int $quantity)
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
    $this->name = $name;
    $this->quantity = $quantity;
  }

  public function addRecipe()
  {
    $pdo =  DataBase::getConnection();
    $sql = "INSERT INTO `recipes` (id, title, description, instruction, difficulty, time, created_at, id_user) VALUE (?,?,?,?,?,?,?,?)";
    $statement = $pdo->prepare($sql);
    return $statement->execute([$this->id, $this->title, $this->description, $this->instruction, $this->difficulty, $this->time, $this->created_at, $this->id_user,]);
  }

  public function getRecipeByTitle($title)
  {
    $pdo =  DataBase::getConnection();
    $sql = "SELECT * FROM `recipes` WHERE title = ?";
    $statement = $pdo->prepare($sql);
    $statement->execute([$title]);
    $recipe = $statement->fetch(PDO::FETCH_ASSOC);
    if ($recipe) {
      return new Recipe($recipe['id'], null, null, null, null, null, null, null, null, null, null);
    } else {
      return null;
    }
  }
}
