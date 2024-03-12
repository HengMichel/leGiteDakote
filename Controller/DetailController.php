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


    public function newDetail()
    {
        // Récupère les paramètres POST
        $room_id = $_POST['id_room'] ?? null;
        $booking_start_date = $_POST['booking_start_date'] ?? null;
        $booking_end_date = $_POST['booking_end_date'] ?? null;
      
        // Charge les données de la chambre à partir de son identifiant
        $room = $this->roomsRepository->findRoomsById($room_id);

        // Initialise $price à null par défaut
        $price = null;

        // Vérifie si la chambre existe
        if ($room) {
            // Récupérer le prix de la chambre
            $price = $room->getPrice();

            // Vérifie si le prix est valide
            if ($price === null) {
                // Gérer le cas où le prix n'a pas pu être récupéré
                echo "Erreur: Prix de la chambre non trouvé.";
                }
            } else {
                // Gérer le cas où le prix n'a pas pu être récupéré
                echo "Erreur: Chambre non trouvée.";
            }

        // Créer une instance de Detail
        $detail = new Detail();
        // Attribuer les valeurs récupérées aux propriétés de l'objet Detail
        $detail->setRoom_id($room_id);
        $detail->setBooking_start_date($booking_start_date);
        $detail->setBooking_end_date($booking_end_date);

        // Passe les données à la vue
        $data = [
            'detail' => $detail,
            'room_id' => $room_id,
            'booking_start_date' => $booking_start_date,
            'booking_end_date' => $booking_end_date,
            'price' => $price,
        ];
        // d_die($data);
    // } else {
    //     echo "Le prix de la chambre n'est pas disponible.";
    // }

        $this->form->handleFormDetail($detail,$room_id);
        // d_die($detail);
        // d_die($this);

        // Vérifie si le formulaire est soumis
        if ($this->form->isSubmitted()) {
        // d_die($detail);

            // Vérifie s'il n'y a pas d'erreurs dans les données soumises
            if ($this->form->isValid()) {
            // d_die($_SESSION);
            // d_die($detail);

                // Ajoute la réservation à la base de données
                $success = $this->detailRepository->addDetail($detail);
                // d_die($success); return bool(true)

                if ($success) {
                // d_die($_SESSION);
                // d_die($detail);

                    // Redirige vers le tableau de bord
                    // return redirection(addLink("detail","show"));
                    return redirection(addLink("home","list"));

                } else {
                    // Gestion d'une éventuelle erreur lors de l'ajout de la réservation
                    $errors = ["Une erreur s'est produite lors de l'ajout de la réservation."];
                }
            }

        }
        // Récupère les erreurs du formulaire
        $errors = $this->form->getEerrorsForm();

        return $this->render("detail/form_detail.php",$data + [
            'detail' => $detail,
            "errors" => $errors
        ]);
    }      

  
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