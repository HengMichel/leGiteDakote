<?php

namespace Controller;

use Service\Session;
use Model\Entity\Bookings;
use Controller\BaseController;
use Form\BookingsHandleRequest;
use Model\Repository\BookingsRepository;
use Model\Repository\RoomsRepository;

class BookingsController extends BaseController
{
    private $bookingsRepository;
    private $form;
    private $bookings;
    private $roomsRepository;

    public function __construct()
    {
        $this->bookingsRepository = new BookingsRepository;
        $this->form = new BookingsHandleRequest;
        $this->bookings = new Bookings;
        $this->roomsRepository = new RoomsRepository;
    }

    public function list(){

        $bookingss = $this->bookingsRepository->findBookings($this->bookings);

        $this->render("bookings/list_bookings.php", [
            "bookingss" => $bookingss
        ]);
    }

    public function newBookings(){

        $bookings = $this->bookings;
        $this->form->handleForm($bookings);

        if ($this->form->isSubmitted() && $this->form->isValid()) {

        // Assurez-vous que user_id est défini sur l'objet $bookings
        $users = Session::isConnected();
        $bookings->setUser_id($users);
        // d_die($bookings); 

        // Assurez-vous que les dates sont correctement définies sur l'objet $bookings
        // avant d'appeler addBookings
        $bookings->setBooking_start_date($_POST['booking_start_date']);
        $bookings->setBooking_end_date($_POST['booking_end_date']);
        // d_die($bookings);    

         
        //S'assurez que room_id est défini sur l'objet $bookings
        $room_id = $_GET['room_id'] ;
        // pour récupérer l'ID de la chambre
        $bookings->setRoom_id($room_id);
            // d_die($bookings);    
        
        // Obtenir le prix de la chambre à partir de la méthode de modèle Rooms donc creation de la methode getPrice dans RoomsRepository.php
        $price = $this->roomsRepository->getPrice($_GET['room_id']);
        // S'assurer que booking_price est défini sur l'objet $bookings
        $bookings->setBooking_price($price);


         // S'assurez que le paiement est effectué avec succès
        // ... Logique de paiement ...

        // Mettez à jour le statut de la réservation après le paiement
        $bookings->setBooking_state("in progress");
        // d_die($bookings);    


        // Enregistrez la réservation dans la base de données
        $this->bookingsRepository->addBookings($bookings);
        // d_die($bookings);    

            return redirection(addLink("users","dashUsers"));
        }

        $errors = $this->form->getEerrorsForm();

        return $this->render("bookings/form_bookings.php",  [
            "bookings" => $bookings,
            "errors" => $errors
        ]);
    }
    
    public function modifBookings($bookings)
    {
        $bookingss = $this->bookingsRepository->cancelBookings($this->bookings);
        $this->bookingsRepository->cancelBookings($bookings);
        return redirection(addLink("bookings"));

    }

    // public function findContestById($id){

    //     $contest = Contest::findContestById($id);

    //     $this->render("list_contest.php");
    // }
}