<?php

namespace Controller;

use Service\Session;
use Model\Entity\Rooms;
use Model\Entity\Detail;
use Form\DetailHandleRequest;
use Controller\BaseController;
use Model\Repository\RoomsRepository;
use Model\Repository\DetailRepository;

class DetailController extends BaseController
{
    private $detailRepository;
    private $roomsRepository;
    
    private $form;
    private $detail;

    public function __construct()
    {
        $this->detailRepository = new DetailRepository;
        $this->roomsRepository = new RoomsRepository;
        $this->form = new DetailHandleRequest;
        $this->detail = new Detail;
    }


//################################ need debug
    public function newDetail()
    {
        // d_die($_SESSION);
        // Récupère les paramètres POST
        // $room_id = $_POST['id_room'] ?? null;
        // $booking_start_date = $_POST['booking_start_date'] ?? null;
        // $booking_end_date = $_POST['booking_end_date'] ?? null;
      
        // Charge les données de la chambre à partir de son identifiant
        // $room = $this->roomsRepository->findRoomsById($room_id);

        // Initialise $price à null par défaut
        // $price = null;

        // Vérifie si la chambre existe
        // if ($room) {
            // Récupère le prix de la chambre
            // $price = $room->getPrice();

            // Vérifie si le prix est valide
        //     if ($price === null) {
        //         // Gère le cas où le prix n'a pas pu être récupéré
        //         echo "Erreur: Prix de la chambre non trouvé.";
        //         return;
        //     }
        // } else {
            // Gère le cas où le prix n'a pas pu être récupéré
        //     echo "Erreur: Chambre non trouvée.";
        //     return;
        // }

        // On crée une instance de Detail
        // $detail = new Detail();
        // Attribue les valeurs récupérées aux propriétés de l'objet Detail
        // $detail->setRoom_id($room_id);
        // $detail->setBooking_start_date($booking_start_date);
        // $detail->setBooking_end_date($booking_end_date);
// d_die($detail);

        // $this->form->handleFormDetail($detail,$room_id);
// d_die( $this->form->handleFormDetail($detail,$room_id));

        $detail = $this->detail;
        $this->form->handleFormDetail($detail);

        // Vérifie si le formulaire est soumis et valide
        if ($this->form->isSubmitted() && $this->form->isValid()) {
            $this->detailRepository->insertDetail($detail);
            return $this->render("detail/form_detail.php", [
                'detail' => $detail,
            ]);

        }else{
            // Récupère les erreurs du formulaire
            $errors = $this->form->getEerrorsForm();
            // d_die($errors);
           
            return $this->render("cart/form_cart.php", [
                
                "errors" => $errors
            ]);
        }
    }
//################################ need debug   

    public function deleteDetail($id)
    {
        // Annule la réservation
        $success = $this->detailRepository->deleteDetail($id);

        if ($success) {
        // d_die($bookings);

        // Redirige vers le tableau de bord
        return redirection(addLink("detail","dashUsers"));

        } else {
            // Récupére les erreurs du formulaire
            $errors = $this->form->getEerrorsForm();
            return $this->render("bookings/form_bookings.php", [
                "errors" => $errors
            ]);
        }
    }
}