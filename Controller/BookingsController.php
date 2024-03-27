<?php

namespace Controller;

use Service\Session;
use Model\Entity\Users;
use Model\Entity\Bookings;
use Controller\BaseController;
use Form\BookingsHandleRequest;
use Model\Repository\DetailRepository;
use Model\Repository\BookingsRepository;

class BookingsController extends BaseController
{
    private $bookingsRepository;
    private $detailRepository;
    private $form;
    private $bookings;

    public function __construct()
    {
        $this->bookingsRepository = new BookingsRepository;
        $this->detailRepository = new DetailRepository;
        $this->form = new BookingsHandleRequest;
        $this->bookings = new Bookings;
    }

    public function list(){

        $bookingss = $this->bookingsRepository->findBookings($this->bookings);

        $this->render("bookings/list_bookings.php", [
            "bookingss" => $bookingss
        ]);
    }

    public function newBookings()
    {
        // Récupère l'utilisateur connecté
        $user = Session::getConnectedUser();
        // d_die($user);
        
        $user_id = $user instanceof Users ? $user->getId_user() : null;
        $booking_state = "in progress";
        // d_die($user_id);

        // Gère le formulaire de réservation
        $this->form->handleForm($this->bookings, $user_id);

        if ($this->form->isSubmitted() && $this->form->isValid()) {     
            // Ajoute la réservation à la base de données
            $success = $this->bookingsRepository->addBookings($this->bookings);
            // d_die($success); return bool(true)
            
            if ($success) {
                return redirection(addLink("detail","newDetail"));
            } else {
                // Gestion d'une éventuelle erreur lors de l'ajout de la réservation
                $errors = ["Une erreur s'est produite lors de l'ajout de la réservation."];
            }
        }
        // Récupère les erreurs du formulaire
        $errors = $this->form->getEerrorsForm();

        // Affiche le formulaire de réservation
        return $this->render("cart/form_cart.php",[
            "user_id" => $user_id,
            "booking_state" => $booking_state,
            "errors" => $errors
        ]);
    }      

    public function cancelBooking($id)
    {
        // Annule la réservation
        $success = $this->bookingsRepository->cancelBooking($id);

        if ($success) {
        // d_die($bookings);

        // Redirige vers le tableau de bord
        return redirection(addLink("users","dashUsers"));

        } else {
            // Récupére les erreurs du formulaire
            $errors = $this->form->getEerrorsForm();
            return $this->render("bookings/form_bookings.php", [
                "errors" => $errors
            ]);
        
        }
    }

}

   