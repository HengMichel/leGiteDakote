<?php

namespace Controller;

use Model\Entity\Users;
use Model\Repository\UsersRepository;
use Form\UsersHandleRequest;
use Service\Session;

class UsersController extends BaseController
{
    private $usersRepository;
    private $form;
    private $users;

    public function __construct()
    {
        $this->usersRepository = new UsersRepository;
        $this->form = new UsersHandleRequest;
        $this->users = new Users;
    }

    public function newUsers()
    {
        $users = $this->users;
        $this->form->handleForm($users);

        if ($this->form->isSubmitted() && $this->form->isValid()) {
            $this->usersRepository->addUsers($users);
            return redirection(addLink("users","loginUsers"));
        }
        $errors = $this->form->getEerrorsForm();

        return $this->render("users/form_users.php", [
            "users" => $users,
            "errors" => $errors
        ]);
    }

    // public function loginUsers()
    // {
    //     $this->render("security/form_login.php", [
    //         "h1" => "Se connecter",
    //         "users" => $this->users,
    //     ]);
    // }

    public function login()
    {
        $users = $this->users;
        $this->form->handleSecurity($users);

        if ($this->form->isSubmitted() && $this->form->isValid()) {

                Session::authentication($users);
                debug($_SESSION);
                d_die($users);

          
                // Si la connexion réussit, redirige l'utilisateur en fonction de son rôle
                // $dashboardPage = ($_SESSION["role"] == "admin") ? "admin/dashboard_admin.php" : "users/dashboard_users.php";

                $dashboardPage = ($_SESSION["role"] == "admin") ? addLink("admin", "dashboard_admin.php") : addLink("users", "dashboard_users.php");

                header("Location: $dashboardPage");
                exit;

                // $errors = $this->form->getEerrorsForm();

                // return $this->render($dashboardPage, [
                //     "users" => $users,
                //     "errors" => $errors 
                // ]);
            
          
        }
            // Si le formulaire n'est pas soumis ou n'est pas valide, affiche le formulaire de connexion

            $errors = $this->form->getEerrorsForm();

            if ($_SESSION["role"] == "admin") {
                // d_die('ok1');
                return $this->render("admin/dashboard_admin.php", [
                    "users" => $users,
                    "errors" => $errors 
                ]);
            } else {
                // d_die('ok2');
            return $this->render("security/form_login.php", [
                "users" => $users,
                "errors" => $errors
            ]);
            }
        }
    // public function decoUsers($users)
    // {
    //     $userss = $this->usersRepository->logoutUsers($this->users);
    //     $this->usersRepository->logoutUsers($users);
    //     return redirection(addLink("home"));
    // }


}
