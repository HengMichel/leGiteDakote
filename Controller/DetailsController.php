<?php

namespace Controller;

use Service\DetailsManager;
use Controller\BaseController;
use Model\Repository\DetailsRepository;

class DetailsController extends BaseController
{
    private $detailsManager;

    // modif ici ###############
    private $detailsRepository;
    // ##########################

    public function __construct()
    {
        $this->detailsManager = new DetailsManager;

        // modif ici ###############
        $this->detailsRepository = new DetailsRepository;
        // ##########################

    }
                            // ajout $id ########
    public function newDetail($id)
    {
        // debug($_POST);
// debug($_SESSION['cart']);
        // Récupérer l'identifiant de l'utilisateur à partir de la session ou d'où il est disponible
        $id_user = $_SESSION['users']->getId_user() ?? null;
        // Récupérer les réservations de l'utilisateur à partir de la session
        $bookings = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
        // debug($bookings);
        // Créer les détails
        $detailsCreated = $this->detailsManager->createDetail($id_user,$bookings);
        // d_die($details);  
        // d_die($id_user,$bookings);  
        // Vérifie si les détails ont été créés avec succès avant de les passer à la vue
        if ($detailsCreated ) 
        {
            // modif ici
            $details = $this->detailsRepository->findDetailByBookingId($id);
            if ($details) {
                // Affiche le contenu des détails pour le débogage
                debug($details);
            }
            // ##########################

            return $this->render("details/form_details2.php", [
                "details" => $details,
                "h1" => "Facture"
            ]);  
        }    
    }
}
