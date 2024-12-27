<?php

namespace App\Utils;


abstract class AbstractController
{
  protected array $arrayError = [];
  protected array  $cart = [];
  protected array $arraySucces = [];

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


  public function check($nameInput, $value)
  {
    $this->isNotEmpty($nameInput);
    $value = htmlspecialchars($value);
    $this->checkFormat($nameInput, $value);
    return $this->arrayError;
  }
}
