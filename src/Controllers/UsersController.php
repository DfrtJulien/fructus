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

    public function login()
    {
        if (isset($_POST['mail'], $_POST['password'])) {
            $this->check("mail", $_POST['mail']);
            $this->check("password", $_POST['password']);

            if (empty($this->arrayError)) {
                $mail = htmlspecialchars($_POST['mail']);
                $password = htmlspecialchars($_POST['password']);

                $user = new Users(null, null, $mail, $password, null);

                //je récupere les info de mon user 
                $getUser = $user->login($mail);

                // je vérifie qu'il existe 
                if ($getUser) {
                    // je récupere le mdp hassher de mon user
                    $passwordHashed = $getUser->getPassword();

                    // je vérifie si le mdp hasher est le même que ce que j'ai recu
                    if (password_verify($password, $passwordHashed)) {

                        // si il éxiste je crée une session avec ses infos
                        $_SESSION['user'] = [
                            'id' => uniqid(),
                            'username' => $getUser->getUsername(),
                            'mail' => $getUser->getMail(),
                            'idUser' => $getUser->getId(),
                            'id' => $getUser->getId(),
                            'id_role' => $getUser->getIdRole()
                        ];
                        $this->redirectToRoute('/');
                    } else {
                        $error = "Le mail ou mot de passe n'est pas correct";
                    }
                } else {
                    $error = "Le mail ou mot de passe n'est pas correct";
                }
            }
        }
        require_once(__DIR__ . '/../Views/security/login.view.php');
    }
}
