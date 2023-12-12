<?php

namespace Controller;

use Model\Entity\Users;
use Model\Repository\UsersRepository;
use Form\UsersHandleRequest;

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

    public function loginUsers()
    {
        $this->render("users/form_login.php", [
            "h1" => "Se connecter",
            "users" => $this->users,
        ]);
    }

    public function coUsers()
    {
        $users = $this->users;
        $this->form->handleSecurity($users);
    
        if ($this->form->isSubmitted() && $this->form->isValid()) {
            // Si la validation du formulaire est réussie, connectez l'utilisateur
            $this->usersRepository->logUsers($users);
        }
        $errors = $this->form->getEerrorsForm();
    
        return $this->render("users/form_login.php", [
            "users" => $users,
            "errors" => $errors
        ]);
    }

    // public function decoUsers($users)
    // {
    //     $userss = $this->usersRepository->logoutUsers($this->users);
    //     $this->usersRepository->logoutUsers($users);
    //     return redirection(addLink("home"));
    // }

}
