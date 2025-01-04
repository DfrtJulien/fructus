<?php

namespace App\Utils;


abstract class AbstractController
{
  protected array $arrayError = [];
  protected array $arraySucces = [];
  protected array $ingredientExist = [];
  protected array $ingredients = [];
  protected array $categoryExist = [];
  protected array $category = [];

  public function ingredientExist()
  {
    // je crée un tableau contenant tout les ingrédient disponible
    $checkIngredient = ["oeuf", "lait", "sucre", "beurre", "farine", "sel", "multifruit", "fraise", "chocolat", "cacao"];

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
      // je check si le tableau contenant tout mes ingrédient a une valeur null
      if ($quantity) {
        // si ce n'est pas null je l'ajoute a ce tableau enelevant tout les NULL du tableau précédent
        $this->ingredients[$value] = $quantity;
      }
    }
    return $this->ingredients;
  }

  public function CategoryExist()
  {

    // je crée un tableau contenant toutes les catégory disponible
    $checkCategory = ["gateaux", "chocolat", "fruit", "fraise", "tarte", "crepe", "multifruit", "vegan"];

    foreach ($checkCategory as $category) {
      // je fait une boucle et je regarde si je récupère en post la valeur
      if (isset($_POST[$category])) {
        // si il existe je l'ajoute dans un tableau
        $this->categoryExist[$category] = $_POST[$category];
      } else {
        // sinon il est null
        $this->categoryExist[$category] = null;
      }
    }

    return $this->categoryExist;
  }

  public function addCategory($array)
  {
    foreach ($array as $category) {
      // je check si le tableau contenant tout mes ingrédient a une valeur null
      if ($category) {
        // si ce n'est pas null je l'ajoute a ce tableau enelevant tout les NULL du tableau précédent
        $this->category[] = $category;
      }
    }
    return $this->category;
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
    $regexNote = '/^(5(?:[.,]0{1,2})?|[0-4](?:[.,]\d{1,2})?)$/';
    $regexDescription = '/^(.|\s)*[a-zA-Z]+(.|\s)*$/';
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
      case 'note':
        if (!preg_match($regexNote, $value)) {
          $this->arrayError['note'] = 'Merci de donné une note correcte';
        }
        break;
      case 'comment':
        if (!preg_match($regexDescription, $value)) {
          $this->arrayError['comment'] = 'Merci de donné un commentaire correcte';
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
