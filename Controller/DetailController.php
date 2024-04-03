<?php

namespace Controller;

use Model\Entity\Detail;
use Controller\BaseController;
use Model\Repository\RoomsRepository;
use Model\Repository\DetailRepository;
use Model\Repository\BookingsRepository;
use Service\DetailManager;

class DetailController extends BaseController
{
    private $detailRepository;
    private $bookingsRepository;

    private $detailManager;

    private $detail;

    // public function __construct($detailManager)
    public function __construct()
    {
        $this->detailManager = new DetailManager;
        $this->detailRepository = new DetailRepository;
        $this->bookingsRepository = new BookingsRepository;
        $this->detail = new Detail;
    }



    public function newDetail()
    {
         // Récupérer les valeurs booking_start_date et booking_end_date depuis la session
         $bookingStartDate = $_SESSION['booking_start_date'] ?? null;
         $bookingEndDate = $_SESSION['booking_end_date'] ?? null;
 
         // Récupère l'ID de la réservation insérée
        //  $bookingId = $this->bookingsRepository->findBookingById($bookingId);
 
         // Maintenant, récupérer l'ID de la chambre associée à cette réservation à partir de la base de données
         $roomId = $this->bookingsRepository->getRoomIdByBookingId($bookingId);
 
         // Utiliser le DetailManager pour créer les détails de réservation
         $detail = $this->detailManager->createDetail($bookingId, $roomId, $bookingStartDate, $bookingEndDate);
 
         return $this->render("detail/form_detail.php", [
             'detail' => $detail,
             "h1" => "Facture"
         ]);
    
    }
// ############################################################################

}