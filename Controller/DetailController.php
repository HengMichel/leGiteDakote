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
// ######  a debug ######################################################
    public function newDetail($id)
    {
        if (!empty($id) && is_numeric($id)) 
        {   
            // Converti l'ID de id_booking en entier
            $id = intval($id); 
// d_die($id);
            // Utilise le DetailManager pour créer le détail de la réservation
            $detailCreated = $this->detailManager->createDetail($id);
// d_die($detailCreated);

            // Vérifier si la création du détail a réussi
            if ($detailCreated) {
// d_die($detailCreated);

                // Récupérer l'ID de la réservation et l'ID de la chambre associée
                $ids = $this->detailRepository->addDetail($id);
d_die($ids);
                if ($ids) {
                    $bookingId = $ids['booking_id'];
                    // d_die($bookingId);

                        // Si la création du détail réussit, rend le formulaire de détail
                        return $this->render("detail/form_detail.php", [
                        'detail' => $detailCreated,
                        "h1" => "Facture"
                        ]);
                    }
            }
        }
    }
}
