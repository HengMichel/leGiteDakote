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

        // d_die($user);
        return $this->render("users/show.php", [
            "users" => $user,
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
        $userId = Session::getConnectedUser();
        // d_die($userId);

        // si l'utilisateur est connecté
        if ($userId instanceof Users) {
            // Utilise l'objet utilisateur pour récupérer le rôle
            $userRole = $userId->getRole();

            // si l'utilisateur est un client
            if($userRole == 'client'){

                // Utilise l'ID de l'utilisateur pour récupérer les réservations
                $findUserBookings = $this->bookingsRepository->findUserBookings($userId->getId_user());
    
                return $this->render("users/dashboard_users.php", [
                "findUserBookings" => $findUserBookings
                ]);  
                // alors si il n'est pas client mais admin donc  
            } elseif ($userRole == 'admin'){
                
                return redirection(addLink("home"));

                }
        }
    }

    public function deco(){

        Session::logout();
        // Redirige l'utilisateur vers la page d'accueil après la déconnexion
        return redirection(addLink("home"));

    }

   

}