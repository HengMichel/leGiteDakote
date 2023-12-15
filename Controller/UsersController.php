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

    public function show($id)
    {
        $user = $this->usersRepository->findUsersById($id);
// ajouter une condition en cas de la valeur null de $user afin d'ajouter un message d'erreur dans la session
        return $this->render("users/show.php", [
            "user" => $user,
            // "errors" => $errors
        ]);
    }

    public function login()
    {
        $users = $this->users;
        $user = $this->form->handleSecurity();

        if ($this->form->isSubmitted() && $this->form->isValid()) {

            Session::authentication($user);
            $id = $user->getId_user();
            return redirection(addLink("users","show", $id));             
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
        $user = $this->users;

        if ($_SESSION["role"] == "admin") {

            return $this->render("admin/dashboard_admin.php", [
                "users" => $user
            ]);
        } else if ($_SESSION["role"] == "client") {
       
            return $this->render("users/dashboard_users.php", [
            "users" => $user
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
