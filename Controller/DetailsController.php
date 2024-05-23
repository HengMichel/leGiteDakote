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
    public function newDetail()
    {
        // debug($_SESSION);

        // debug($_POST);
// debug($_SESSION['cart']);
        // Récupérer l'identifiant de l'utilisateur à partir de la session ou d'où il est disponible
        $id_user = $_SESSION['users']->getId_user() ?? null;
        // Récupérer les réservations de l'utilisateur à partir de la session
        $rooms = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

 // Vérifier si le panier contient des réservations
 if (empty($rooms)) {
    return $this->render("details/form_details2.php", [
        "details" => null,
        "h1" => "Aucun détail trouvé"
    ]);
}
 // Obtenir l'ID de réservation du premier élément du panier (ou d'un élément approprié)
 $room = $rooms[0];
// debug($_SESSION);
 $room_id = $room['room']->getId_room();

        // Vérifiez d'abord si les détails existent déjà
    $existingDetails = $this->detailsRepository->findDetailByRoomId($room_id);

    if ($existingDetails !== null) {
        debug($existingDetails);
        return $this->render("details/form_details2.php", [
            "details" => $existingDetails,
            "h1" => "Facture"
        ]);
    }
        debug('Creating details with user id:', $id_user, 'and rooms:', $rooms);

        // Créer les détails
        $detailsCreated = $this->detailsManager->createDetail($id_user,$rooms);
        // d_die($details);  
        // d_die($id_user,$rooms); 
        
        debug('Details created status:', $detailsCreated);

        // Vérifie si les détails ont été créés avec succès avant de les passer à la vue
        if ($detailsCreated ) 
        {
            // modif ici
            debug('Details created successfully. Fetching details for room id:', $rooms);

            $details = $this->detailsRepository->findDetailByRoomId($room_id);

            if ($details !== null) {
                debug('Details found:', $details);
                return $this->render("details/form_details2.php", [
                    "details" => $details,
                    "h1" => "Facture"
                ]);  
            } else {
                debug('No details found for rooms:', $room_id);
                return $this->render("details/form_details2.php", [
                    "details" => null,
                    "h1" => "Aucun détail trouvé"
                ]);
            } 

        } else {
            debug('Error creating details');
                return $this->render("details/form_details2.php", [
                    "details" => null,
                    "h1" => "Erreur lors de la création des détails"
                ]); 

        }    
    }
}
