<?php

namespace Controller;

use Model\Entity\Details;
use Controller\BaseController;
use Model\Repository\RoomsRepository;
use Model\Repository\DetailsRepository;
use Model\Repository\BookingsRepository;
use Service\DetailsManager;

class DetailsController extends BaseController
{
    private $detailsRepository;
    private $bookingsRepository;

    private $detailsManager;

    private $details;

    // public function __construct($detailManager)
    public function __construct()
    {
        $this->detailsManager = new DetailsManager;
        $this->detailsRepository = new DetailsRepository;
        $this->bookingsRepository = new BookingsRepository;
        $this->details = new Details;
    }
// ######  a debug ######################################################
    public function newDetail($id)
    {
       $details = $this->details;

        // Créer les détails
        // $this->detailsManager->createDetail($id);
        
        // Récupérer les détails créés
        $details = $this->detailsRepository->findDetailById($id);
d_die($details);            
        // Vérifier si les détails existent
        // if ($details !== null) { 

            return $this->render("details/form_details.php", [
                    'detail' => $details,
                    "h1" => "Facture"
                    ]);
                
        // }
        
    }
}
