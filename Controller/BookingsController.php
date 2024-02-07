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

    public function list(){

        $bookingss = $this->bookingsRepository->findBookings($this->bookings);

        $this->render("bookings/list_bookings.php", [
            "bookingss" => $bookingss
        ]);
    }

    public function newBookings()
    {
        // Récupère les paramètres GET
        $room_id = $_POST['room_id'] ?? null;
        $price = $_POST['price'] ?? null;
        $room_imgs = $_POST['room_imgs'] ?? null;
        $room_state = $_POST['room_state'] ?? null;

        // Instancie l'objet Bookings avec les données appropriées
        $bookings = new Bookings();
        $bookings->setRoom_id($room_id);
        $bookings->setBooking_price($price);

        // d_die($bookings);
        // d_die($room_id, $price, $room_imgs, $room_state, $bookings);

         // Récupère l'utilisateur connecté
         $user = Session::getConnectedUser();

         // S'assurer que user_id est défini sur l'objet $bookings
         if ($user instanceof Users) {
            //  d_die($_SESSION);
             $bookings->setUser_id($user->getId_user());
         }

         // Passe les données à la vue
         $data = [
            'bookings' => $bookings,
            'room_id' => $room_id,
            'price' => $price,
            'room_imgs' => $room_imgs,
            'room_state' => $room_state,
        ];

        // d_die($rooms)
        $this->form->handleForm($bookings);

        // Vérifie si le formulaire est soumis
        if ($this->form->isSubmitted()) {
            // d_die($bookings);

            // Vérifie s'il n'y a pas d'erreurs dans les données soumises
            if ($this->form->isValid()) {
                // d_die($_SESSION);
                // d_die($bookings);

                // Ajoute la réservation à la base de données
                $success = $this->bookingsRepository->addBookings($bookings);
                // d_die($success); return bool(true)
                if ($success) {
                    // d_die($_SESSION);
                    // d_die($bookings);

                    // Redirige vers le tableau de bord
                    return redirection(addLink("users","dashUsers"));

                } else {
                    // Gestion d'une éventuelle erreur lors de l'ajout de la réservation
                    $errors = ["Une erreur s'est produite lors de l'ajout de la réservation."];
                }
            }

        }
        // Récupère les erreurs du formulaire
        $errors = $this->form->getEerrorsForm();

        return $this->render("bookings/form_bookings.php",$data + [
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