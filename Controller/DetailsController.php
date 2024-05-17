<?php

namespace Controller;

use Service\DetailsManager;
use Controller\BaseController;

class DetailsController extends BaseController
{
    private $detailsManager;

    public function __construct()
    {
        $this->detailsManager = new DetailsManager;
    }

    public function newDetail()
    {
        // debug($_POST);
debug($_SESSION['cart']);
        // Récupérer l'identifiant de l'utilisateur à partir de la session ou d'où il est disponible
        $id_user = $_SESSION['users']->getId_user() ?? null;
        // Récupérer les réservations de l'utilisateur à partir de la session
        $bookings = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
        // debug($bookings);
        // Créer les détails
        $details = $this->detailsManager->createDetail($id_user,$bookings);
        // d_die($details);  
        // d_die($id_user,$bookings);  
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
