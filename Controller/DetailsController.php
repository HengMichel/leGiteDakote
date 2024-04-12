<?php

namespace Controller;

use Model\Entity\Details;
use Service\DetailsManager;
use Controller\BaseController;
use Model\Repository\DetailsRepository;
use Model\Repository\BookingsRepository;

class DetailsController extends BaseController
{
    private $detailsRepository;
    private $bookingsRepository;
    private $detailsManager;

    public function __construct()
    {
        $this->detailsManager = new DetailsManager;
        $this->detailsRepository = new DetailsRepository;
        $this->bookingsRepository = new BookingsRepository;
    }

    public function newDetail()
    {
        // d_die($id_user);
        // Récupérer l'identifiant de l'utilisateur à partir de la session ou d'où il est disponible
        $id_user = $_SESSION['users']->getId_user() ?? null;

        // Récupérer les réservations de l'utilisateur à partir de la session
        $bookings = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
        // d_die($bookings);
        // Créer les détails
        $details = $this->detailsManager->createDetail($id_user,$bookings);
        // d_die($details);  
        // Vérifie si les détails ont été créés avec succès avant de les passer à la vue
        if ($details) 
        {
            return $this->render("details/form_details.php", [
                "details" => $details,
                "h1" => "Facture"
            ]);  
        }    
    }
}
