<?php

namespace Controller;

use Service\Session;
use Model\Entity\Rooms;
use Model\Entity\Detail;
use Controller\BaseController;
use Form\DetailHandleRequest;
use Model\Repository\DetailRepository;

class DetailController extends BaseController
{
    private $detailRepository;
    private $form;
    private $detail;

    public function __construct()
    {
        $this->detailRepository = new detailRepository;
        $this->form = new DetailHandleRequest;
        $this->detail = new Detail;
    }


    public function newDetail()
    {
        // Récupère les paramètres POST
        $idRoom = $_POST['id_room'] ?? null;
        // d_die($room_id,);

        // $booking_id = $_POST['booking_id'] ?? null;
        // d_die($booking_id,);

        $booking_start_date = $_POST['booking_start_date'] ?? null;
        // d_die($booking_start_date,);
        
        $booking_end_date = $_POST['booking_end_date'] ?? null;
        // d_die($booking_end_date,);

        // Instancie l'objet Bookings avec les données appropriées
        $detail = new detail();
        $detail->setRoom_id($idRoom);
        // d_die($room_id);

        // $detail->setBooking_Id($booking_id);
        // d_die($room_id);

        $detail->setBooking_start_date($booking_start_date);
        // d_die($booking_start_date);   

        $detail->setBooking_end_date($booking_end_date);
        // d_die($booking_start_date);

//################################################ pas de user connecté ici  
        // Récupère l'utilisateur connecté
        // $user = Session::getConnectedUser();

        //  S'assurer que user_id est défini sur l'objet $detail
        // if ($detail instanceof Detail) {
        //      $detail->setRoom_id($detail->getRoom_id());
        // }
// #####################################################################################

        // Passe les données à la vue
        $data = [
            'detail' => $detail,
            'id_room' => $idRoom,
            // 'booking_id' => $booking_id,
            'booking_start_date' => $booking_start_date,
            'booking_end_date' => $booking_end_date,
        ];
        // d_die($rooms)

        $this->form->handleFormDetail($detail);
        // d_die($detail);


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
                    return redirection(addLink("detail","show"));

                } else {
                    // Gestion d'une éventuelle erreur lors de l'ajout de la réservation
                    $errors = ["Une erreur s'est produite lors de l'ajout de la réservation."];
                }
            }

        }
        // Récupère les erreurs du formulaire
        $errors = $this->form->getEerrorsForm();

        return $this->render("detail/form_detail.php",$data + [
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