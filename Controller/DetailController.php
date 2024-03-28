<?php

namespace Controller;

use Service\Session;
use Model\Entity\Rooms;
use Model\Entity\Detail;
use Controller\BaseController;
use Model\Repository\RoomsRepository;
use Model\Repository\DetailRepository;
use Model\Repository\BookingsRepository;

class DetailController extends BaseController
{
    private $detailRepository;
    private $roomsRepository;
    private $bookingsRepository;
    
    private $form;
    private $detail;

    public function __construct()
    {
        $this->detailRepository = new DetailRepository;
        $this->roomsRepository = new RoomsRepository;
        $this->bookingsRepository = new BookingsRepository;
        $this->detail = new Detail;
    }

    public function newDetail()
    {
        // Récupère l'ID de la réservation insérée
        $bookingId = $this->bookingsRepository->getLastInsertedBookingId();
        // d_die($bookingId);
         // Maintenant, récupére l'ID de la chambre associée à cette réservation à partir de la base de données
        $roomId = $this->bookingsRepository->getRoomIdByBookingId($bookingId);
        // d_die($roomId);
        // Crée un nouvel objet Detail pour insérer les détails de réservation
        $detail = new Detail();
        $detail->setBooking_id($bookingId);
        $detail->setRoom_id($roomId);
   
    
        // Insère les détails de réservation dans la table de jointure detail
        $this->detailRepository->insertDetail($detail);
            return $this->render("detail/form_detail.php", [
                'detail' => $detail,
                "h1" => "Facture"
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