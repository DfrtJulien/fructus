<?php

namespace App\Models;

use PDO;
use Config\DataBase;

class Comment extends Recipe
{
  protected ?int $id;
  protected ?string $content;
  protected ?float $rating;
  protected ?string $created_at;
  protected string|null $updated_at;
  protected ?int $id_user;
  protected ?int $id_recipe;

  public function __construct(?int $id, ?string $content, ?float $rating, ?string $created_at, string|null $updated_at, ?int $id_user, ?int $id_recipe)
  {
    $this->id = $id;
    $this->content = $content;
    $this->rating = $rating;
    $this->created_at = $created_at;
    $this->updated_at = $updated_at;
    $this->id_user = $id_user;
    $this->id_recipe = $id_recipe;
  }

  public function addNoteAndcomment()
  {
    $pdo =  $pdo =  DataBase::getConnection();
    $sql = "INSERT INTO `rating_comment` (id, content,rating,created_at,id_user,id_recipe) VALUE (?,?,?,?,?,?)";
    $statement = $pdo->prepare($sql);
    return $statement->execute([$this->id, $this->content, $this->rating, $this->created_at, $this->id_user, $this->id_recipe]);
  }
}
