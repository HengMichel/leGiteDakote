<?php

namespace Controller;

use Service\Session;
use Model\Entity\Users;
use Service\ImageHandler;
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

    public function list(){

        $bookingss = $this->bookingsRepository->findBookings($this->bookings);

        $this->render("bookings/list_bookings.php", [
            "bookingss" => $bookingss
        ]);
    }

    public function newBookings()
    {
        // Récupérer les paramètres GET
        $room_id = $_GET['room_id'] ?? null;
        $price = $_GET['price'] ?? null;
        $room_imgs = $_GET['room_imgs'] ?? null;
        $room_state = $_GET['room_state'] ?? null;

        // Instancier l'objet Bookings avec les données appropriées
        $bookings = new Bookings();
        $bookings->setRoom_id($room_id);
        $bookings->setBooking_price($price);

        // d_die($room_id, $price, $room_imgs, $room_state, $bookings);

         // Récupérez l'utilisateur connecté
         $user = Session::getConnectedUser();

         // Assurez-vous que user_id est défini sur l'objet $bookings
         if ($user instanceof Users) {
             // d_die($_SESSION);
             $bookings->setUser_id($user->getId_user());
         }

         // Passez les données à la vue
        //  $data = [
        //     'bookings' => $bookings,
        //     'room_id' => $room_id,
        //     'price' => $price,
        //     'room_imgs' => $room_imgs,
        //     'room_state' => $room_state,
        // ];

        $this->form->handleForm($bookings);

        // Vérifiez si le formulaire est soumis
        if ($this->form->isSubmitted()) {
            // d_die($bookings);

            // Vérifiez s'il n'y a pas d'erreurs dans les données soumises
            if ($this->form->isValid()) {
                // d_die($_SESSION);
                // d_die($bookings);

                // ajout code ici pour le changement du chemin pour les images via le repertoire uploads et a l aide de Service ImageHandler.php
                ImageHandler::handelPhoto($room_imgs);

                // Ajoutez la réservation à la base de données
                $success = $this->bookingsRepository->addBookings($bookings);
                // d_die($success); return bool(true)
                if ($success) {
                    // d_die($_SESSION);
                    // d_die($bookings);

                    // Redirigez vers le tableau de bord
                    return redirection(addLink("users","dashUsers"));

                } else {
                    // Gestion d'une éventuelle erreur lors de l'ajout de la réservation
                    $errors = ["Une erreur s'est produite lors de l'ajout de la réservation."];
                }
            }

        }
        // Récupérez les erreurs du formulaire
        $errors = $this->form->getEerrorsForm();

        // return $this->render("bookings/form_bookings.php",$data + [
        //     "errors" => $errors
        return $this->render("bookings/form_bookings.php", [
            "errors" => $errors
        ]);
    }      

  
    public function cancelBooking($id)
    {
        // Annuler la réservation
        $success = $this->bookingsRepository->cancelBooking($id);

        if ($success) {
        // d_die($bookings);

        // Redirigez vers le tableau de bord
        return redirection(addLink("users","dashUsers"));

        } else {
            // Récupérez les erreurs du formulaire
            $errors = $this->form->getEerrorsForm();
            return $this->render("bookings/form_bookings.php", [
                "errors" => $errors
            ]);
        
        }
    }
}