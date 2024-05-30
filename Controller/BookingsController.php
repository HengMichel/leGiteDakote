<?php

namespace Controller;

use Service\Session;
use Model\Entity\Users;
use Model\Entity\Bookings;
use Controller\BaseController;
use Form\BookingsHandleRequest;
use Model\Repository\BookingsRepository;

class BookingsController extends BaseController
{
    private $bookingsRepository;
    private $form;
    private $bookings;

    public function __construct()
    {
        $this->bookingsRepository = new BookingsRepository;
        $this->form = new BookingsHandleRequest;
        $this->bookings = new Bookings;
    }

    public function list()
    {
        $bookingss = $this->bookingsRepository->findBookings($this->bookings);
        $this->render("bookings/list_bookings.php", [
            "bookingss" => $bookingss
        ]);
    }

    public function newBookings()
    {
        // Récupère l'utilisateur connecté
        $user = Session::getConnectedUser();
    // debug($user);
        // debug($_SESSION);
        $user_id = $user instanceof Users ? $user->getId_user() : null;
    debug($user_id);

        // Gère le formulaire de réservation
        $this->form->handleForm($this->bookings, $user_id);
    // debug($this->bookings);

        if ($this->form->isSubmitted() && $this->form->isValid()) 
        {            
            // Ajoute la réservation à la base de données
            $id_booking = $this->bookingsRepository->addBookings($this->bookings);
    // debug($id_booking);

            if ($id_booking) 
            {
                // Stockez l'ID de réservation dans la session
                $_SESSION['booking_id'] = $id_booking;

                return redirection(addLink("details","newDetail"));
            } else 
            {
                // Gestion d'une éventuelle erreur lors de l'ajout de la réservation
                $errors = ["Une erreur s'est produite lors de l'ajout de la réservation."];
    // debug($errors); // Débogage des erreurs

            }
        
        }
        
        // Récupère les erreurs du formulaire
        $errors = $this->form->getEerrorsForm();
        // Affiche le formulaire de réservation
        return $this->render("cart/form_cart.php",[
            "user_id" => $user_id,
            "booking_state" => "in progress",
            "errors" => $errors
        ]);
    }      
}

