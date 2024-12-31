<?php

namespace App\Utils;


abstract class AbstractController
{
  protected array $arrayError = [];
  protected array $arraySucces = [];
  protected array $ingredientExist = [];
  protected array $ingredients = [];

  public function ingredientExist()
  {
    // je crée un tableau contenant tout les ingrédient disponible
    $checkIngredient = ["eggs", "milk", "sugar", "butter"];

    foreach ($checkIngredient as $ingredient) {
      // je fait une boucle et je regarde si je récupère en post la valeur
      if (isset($_POST[$ingredient])) {
        // si il existe je l'ajoute dans un tableau
        $this->ingredientExist[$ingredient] = $_POST[$ingredient];
      } else {
        // sinon il est null
        $this->ingredientExist[$ingredient] = null;
      }
    }

    return $this->ingredientExist;
  }


  public function addIngredient($array)
  {

    foreach ($array as $value => $quantity) {
      // je check si le tableau contenant tout mes ingrédient a une valeur nul
      if ($quantity) {
        // si ce n'est pas null je l'ajoute a ce tableau enelevant tout les NULL du tableau précédent
        $this->ingredients[$value] = $quantity;
      }
    }
    return $this->ingredients;
  }

  public function test($array)
  {
    foreach ($array as $key => $value) {
      var_dump($value . " " . $key);
    }
  }

  public function redirectToRoute($route)
  {
    http_response_code(303);
    header("Location: {$route} ");
    exit;
  }

  public function isNotEmpty($value)
  {
    if (empty($_POST[$value])) {
      $this->arrayError[$value] = "Le champ $value ne peut pas être vide.";
      return $this->arrayError;
    }
    return false;
  }

  public function checkFormat($nameInput, $value)
  {
    $regexName = '/^[a-zA-Zà-üÀ-Ü -]{2,255}$/';
    $regexPassword = '/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/';

    switch ($nameInput) {
      case 'name':
        if (!preg_match($regexName, $value)) {
          $this->arrayError['name'] = 'Merci de renseigner un prénom correcte!';
        }
        break;
      case 'mail':
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
          $this->arrayError['mail'] = 'Merci de renseigner un e-mail correcte!';
        }
        break;
      case 'password':
        if (!preg_match($regexPassword, $value)) {
          $this->arrayError['password'] = 'Merci de donné un mot de passe avec au minimum : 8 caractères, 1 majuscule, 1 miniscule, 1 caractère spécial!';
        }
        break;
    }
  }

  public function showMsg()
  {
    $this->arraySucces['register'] = "Inscription réussi !";
    return $this->arraySucces;
  }

  public function check($nameInput, $value)
  {
    $this->isNotEmpty($nameInput);
    $value = htmlspecialchars($value);
    $this->checkFormat($nameInput, $value);
    return $this->arrayError;
  }
}
