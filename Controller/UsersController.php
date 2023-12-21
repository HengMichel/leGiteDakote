<?php

namespace Controller;

use Service\Session;
use Model\Entity\Users;
use Model\Entity\Bookings;
use Form\UsersHandleRequest;
use Model\Repository\UsersRepository;
use Model\Repository\BookingsRepository;

class UsersController extends BaseController
{
    private $usersRepository;
    private $bookingsRepository;
    private $form;
    private $users;

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
        // ajout d'une condition en cas de la valeur null de $user afin d'ajouter un message d'erreur dans la session
        return $this->render("users/show.php", [
            "user" => $user,
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
         // Obtenez l'ID de l'utilisateur connecté
        $userId = Session::getConnectedUser()->getId_user();
        // d_die($userId);

        // Créez une instance de la classe Bookings pour l'utiliser comme argument
        // $bookings = new Bookings();

        // Utilisez l'ID de l'utilisateur pour récupérer les réservations
        $findUserBookings = $this->bookingsRepository->findUserBookings($userId);

        return $this->render("users/dashboard_users.php", [
            "findUserBookings" => $findUserBookings
            ]);            
    }

    public function deco(){

        Session::logout();
        // Redirigez l'utilisateur vers la page d'accueil après la déconnexion
        return redirection(addLink("home"));

    }

    // public function usersBook($id)
    // {
    //     $user = $this->usersRepository->findUsersById($id);
    //     $this->user->addBookings();
    //     if($this)
    //     $this->usersRepository->logoutUsers($users);
    //     return redirection(addLink("home"));
    // }


}