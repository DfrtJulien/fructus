<?php

namespace App\Models;

use PDO;
use Config\DataBase;

class Users
{

  protected ?int $id;
  protected ?string $username;
  protected ?string $mail;
  protected ?string $password;
  protected ?int $id_role;

  public function __construct(?int $id, ?string $username, ?string $mail, ?string $password, ?int $id_role)
  {
    $this->id = $id;
    $this->username = $username;
    $this->mail = $mail;
    $this->password = $password;
    $this->id_role = $id_role;
  }

  public function register()
  {
    $pdo =  DataBase::getConnection();
    $sql = "INSERT INTO `users` (id, username,email,password,id_role) VALUE (?,?,?,?,?)";
    $statement = $pdo->prepare($sql);
    return $statement->execute([$this->id, $this->username, $this->mail, $this->password, $this->id_role]);
  }

  public function userAlreadyExist($mail)
  {
    $pdo =  DataBase::getConnection();
    $sql = "SELECT * FROM `users` WHERE email = ?";
    $statement = $pdo->prepare($sql);
    $statement->execute([$mail]);
    return $statement->fetch();
  }

  public function login($mail)
  {
    $pdo =  DataBase::getConnection();
    $sql = "SELECT * FROM `users` WHERE email = ?";
    $statement = $pdo->prepare($sql);
    $statement->execute([$mail]);
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    if ($row) {
      if ($row['id_role'] === 1) {
        return new Users($row['id'], $row['username'], $row['email'], $row['password'], $row['id_role']);
      } elseif ($row['id_role'] === 2) {
        return new Users($row['id'], $row['username'], $row['email'], $row['password'], $row['id_role']);
      } else {
        return null;
      }
    }
  }

  public function getId(): ?int
  {
    return $this->id;
  }

  public function getMail(): ?string
  {
    return $this->mail;
  }

  public function getPassword(): ?string
  {
    return $this->password;
  }

  public function getUsername(): ?string
  {
    return $this->username;
  }

  public function getIdRole(): ?int
  {
    return $this->id_role;
  }


  public function setId(int $id): static
  {
    $this->id = $id;
    return $this;
  }

  public function setMail(string $mail): static
  {
    $this->mail = $mail;
    return $this;
  }

  public function setPassword(string $password): static
  {
    $this->password = $password;
    return $this;
  }

  public function setUserName(string $username): static
  {
    $this->username = $username;
    return $this;
  }
}
