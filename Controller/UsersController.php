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
            return redirection(addLink("users","login"));
        }
        $errors = $this->form->getEerrorsForm();

        return $this->render("users/form_users.php", [
            "users" => $users,
            "errors" => $errors
        ]);
    }

    public function login()
    {
        $users = $this->users;
        $user = $this->form->handleSecurity($users);

        if ($this->form->isSubmitted() && $this->form->isValid()) {

            Session::authentication($user);

            // Si la connexion réussit, redirige l'utilisateur en fonction de son rôle
            if ($_SESSION["role"] == "admin") {
          
                return $this->render("admin/dashboard_admin.php", [
                    "users" => $user
                ]);
            } else if ($_SESSION["role"] == "client") {
           
                return $this->render("users/show.php", [
                "users" => $user
                ]); 
            }              
        }
        $errors = $this->form->getEerrorsForm();
        // Si le formulaire n'est pas soumis ou n'est pas valide, affiche le formulaire de connexion            
        return $this->render("security/form_login.php", [
            "users" => $users,
            "errors" => $errors
            ]);
    }
    
    public function dashUsers()
    {
        $this->render("users/dashboard_users.php");
    }
    
    // public function decoUsers($users)
    // {
    //     $userss = $this->usersRepository->logoutUsers($this->users);
    //     $this->usersRepository->logoutUsers($users);
    //     return redirection(addLink("home"));
    // }


}
