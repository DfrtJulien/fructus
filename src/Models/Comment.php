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
  protected ?string $username;
  protected ?int $id_user_comment;

  public function __construct(?int $id, ?string $content, ?float $rating, ?string $created_at, string|null $updated_at, ?int $id_user, ?int $id_recipe, ?string $username, ?int $id_user_comment)
  {
    $this->id = $id;
    $this->content = $content;
    $this->rating = $rating;
    $this->created_at = $created_at;
    $this->updated_at = $updated_at;
    $this->id_user = $id_user;
    $this->id_recipe = $id_recipe;
    $this->username = $username;
    $this->id_user_comment = $id_user_comment;
  }

  public function addNoteAndcomment()
  {
    $pdo =  $pdo =  DataBase::getConnection();
    $sql = "INSERT INTO `rating_comment` (id, content,rating,created_at,id_user,id_recipe) VALUE (?,?,?,?,?,?)";
    $statement = $pdo->prepare($sql);
    return $statement->execute([$this->id, $this->content, $this->rating, $this->created_at, $this->id_user, $this->id_recipe]);
  }

  public function getNumberComment()
  {
    $pdo = DataBase::getConnection();
    $sql = "SELECT COUNT(content) FROM `rating_comment` WHERE id_recipe = ?";
    $statement = $pdo->prepare($sql);
    $statement->execute([$this->id_recipe]);
    return $resultFetch = $statement->fetch(PDO::FETCH_ASSOC);
  }

  public function sumArticleNote()
  {
    $pdo = DataBase::getConnection();
    $sql = "SELECT SUM(rating)
                FROM `rating_comment`
                WHERE `id_recipe` = ?";
    $statement = $pdo->prepare($sql);
    $statement->execute([$this->id_recipe]);
    return $resultFetch = $statement->fetch(PDO::FETCH_ASSOC);
  }

  public function getAllCommentsByRecipeId()
  {
    $pdo = DataBase::getConnection();
    $sql = "SELECT `rating_comment`.`id` AS `id_comment`, `rating_comment`.`content`, `rating_comment`.`rating`, `rating_comment`.`created_at`, `rating_comment`.`updated_at`, `rating_comment`.`id_user`, `users`.`id`, `users`.`username`
     FROM `rating_comment`
    RIGHT JOIN `users` ON `rating_comment`.`id_user` = `users`.`id`
    WHERE `rating_comment`.`id_recipe` = ?";
    $statement = $pdo->prepare($sql);
    $statement->execute([$this->id_recipe]);
    $fetchedComments = $statement->fetchAll(PDO::FETCH_ASSOC);
    $comments = [];
    if ($fetchedComments) {
      foreach ($fetchedComments as $comment) {
        $comments[] =  new Comment($comment['id_comment'], $comment['content'], $comment['rating'], $comment['created_at'], $comment['updated_at'], $comment['id_user'], null, $comment['username'], $comment['id']);
      }
      return $comments;
    }
  }

  public function getNoteByUserId()
  {
    $pdo = DataBase::getConnection();
    $sql = "SELECT `id`, `rating` FROM `rating_comment` WHERE `id_recipe` = ? AND `id_user` = ?";
    $statement = $pdo->prepare($sql);
    $statement->execute([$this->id_recipe, $this->id_user]);
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    if ($row) {
      return new Comment($row['id'], null, $row['rating'], null, null, null, null, null, null);
    } else {
      return null;
    }
  }

  public function getRecipeMostLiked()
  {
    $pdo = DataBase::getConnection();
    $sql = "SELECT id_recipe, COUNT(*) AS comment_count
            FROM rating_comment
            GROUP BY id_recipe
            ORDER BY comment_count DESC
            LIMIT 1";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    if ($row) {
      return new Comment(null, null, null, null, null, null, $row['id_recipe'], null, null);
    } else {
      return null;
    }
  }

  public function getCommentById()
  {
    $pdo = DataBase::getConnection();
    $sql = "SELECT `id`, `content`, `rating` FROM rating_comment WHERE id = ?";
    $statement = $pdo->prepare($sql);
    $statement->execute([$this->id]);
    $fetchedComment = $statement->fetch(PDO::FETCH_ASSOC);
    if ($fetchedComment) {
      return new Comment(null, $fetchedComment['content'], $fetchedComment['rating'], null, null, null, null, null, null);
    } else {
      return null;
    }
  }

  public function editComment()
  {
    $pdo = DataBase::getConnection();
    $sql = "UPDATE rating_comment SET `content` = ? , `rating` = ?, `updated_at` = ? WHERE id = ?";
    $statement = $pdo->prepare($sql);
    return $statement->execute([$this->content, $this->rating, $this->updated_at, $this->id]);
  }


  public function deleteCommentById()
  {
    $pdo = DataBase::getConnection();
    $sql = "DELETE FROM `rating_comment` WHERE id = ?";
    $statement = $pdo->prepare($sql);
    return $statement->execute([$this->id]);
  }

  public function getId(): ?int
  {
    return $this->id;
  }

  public function getContent(): ?string
  {
    return $this->content;
  }

  public function getRating(): ?int
  {
    return $this->rating;
  }

  public function getCreation_date(): ?string
  {
    return $this->created_at;
  }

  public function getId_user(): ?int
  {
    return $this->id_user;
  }

  public function getId_recipe(): ?int
  {
    return $this->id_recipe;
  }

  public function getUpdated_date(): ?string
  {
    return $this->updated_at;
  }

  public function getUsername(): ?string
  {
    return $this->username;
  }
}
