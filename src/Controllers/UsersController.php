<?php

namespace App\Controllers;

use App\Utils\AbstractController;
use App\Models\Users;

class UsersController extends AbstractController
{
  public function register()
  {

    if (isset($_POST['name'], $_POST['mail'], $_POST['password'])) {
      $this->check("name", $_POST['name']);
      $this->check("mail", $_POST['mail']);
      $this->check("password", $_POST['password']);

      if (empty($this->arrayError)) {
        $name = htmlspecialchars($_POST['name']);
        $mail = htmlspecialchars($_POST['mail']);
        $password = htmlspecialchars($_POST['password']);
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $id_role = 2;

        $user = new Users(null, $name, $mail, $passwordHash, $id_role);

        // je regarde si l'utilisateur existe déja
        $userExist = $user->userAlreadyExist($mail);

        // si il n'existe pas je l'enregistre dans ma BDD
        if (!$userExist) {

          $user->register();
        } else {
          // sinon je le redirige vers la page de connexion
          $this->redirectToRoute('/login');
        }
      }
    }

    require_once(__DIR__ . '/../Views/security/register.view.php');
  }
}
