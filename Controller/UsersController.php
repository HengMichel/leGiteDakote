<?php

namespace Controller;

use Service\Session;
use Model\Entity\Users;
use Form\UsersHandleRequest;
use Model\Repository\UsersRepository;
use Model\Repository\BookingsRepository;

class UsersController extends BaseController
{   
    // ##### les propriétées #####
    private $usersRepository;
    private $bookingsRepository;
    private $form;
    private $users;
    // ###########################
    public function __construct()
    {
        $this->usersRepository = new UsersRepository;
        $this->bookingsRepository = new BookingsRepository;
        $this->form = new UsersHandleRequest;
        $this->users = new Users;
    }

    public function newUsers()
    {
        $users = $this->users;
        $this->form->handleForm($users);
        if ($this->form->isSubmitted() && $this->form->isValid()) 
        {
            $this->usersRepository->addUsers($users);
            return redirection(addLink("users","login"));
        }
        $errors = $this->form->getEerrorsForm();
        return $this->render("users/form_users.php", [
            "h1" => "Inscription",
            "users" => $users,
            "errors" => $errors
        ]);
    }

    public function show($id)
    {
        $user = $this->usersRepository->findUsersById($id);
        // d_die($user);
        return $this->render("users/show.php", [
            "h1" => "Mon profil",
            "users" => $user,
        ]);
    }

    public function login()
    {
        $users = $this->users;
        $user = $this->form->handleSecurity();
        if ($this->form->isSubmitted() && $this->form->isValid()) 
        {
            Session::authentication($user);
            $id = $user->getId_user();
            return redirection(addLink("users","show", $id));             
        }
        $errors = $this->form->getEerrorsForm();
        // Si le formulaire n'est pas soumis ou n'est pas valide, affiche le formulaire de connexion            
        return $this->render("security/form_login.php", [
            "h1" => "Connexion",
            "users" => $users,
            "errors" => $errors
            ]);
    }
    public function editUser($id)
    {
        // Récupérer les modifications du profil à partir de l'identifiant $id
        $users = $this->usersRepository->findUsersById($id);
        // d_die($users);
        // Passer les modifications du profil à la vue
        $this->render("users/form_modif_users.php", [
            "h1" => "Modifier le profil",
            "users" => $users
        ]);
    }
    public function updateUser($id)
    {
        $users = $this->usersRepository->findUsersById($id);
        // d_die($users);
        $this->form->handleFormModif($users);
        // d_die($users);
        if ($this->form->isSubmitted() && $this->form->isValid())  
        {
            // d_die($users);
            $this->usersRepository->updateUsers($users); 
            // d_die($users);
            return redirection(addLink("users","show",$users->getId_user()));
        }
        else
        {
            $errors = $this->form->getEerrorsForm();
            return $this->render("users/form_modif_users.php", [
                "users" => $users,
                "errors" => $errors
            ]);
        }
    }
    
    public function deco()
    {
        Session::logout();
        // Redirige l'utilisateur vers la page d'accueil après la déconnexion
        return redirection(addLink("home"));
    }
}