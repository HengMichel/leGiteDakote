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
    private $details;
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
        // $rooms = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$booking_id = $_SESSION['cart'] ?? [];
// debug($booking_id);

 // Vérifier si le panier contient des réservations
 if (empty($booking_id)) 
 {
    return $this->render("details/form_details2.php", [
        "details" => null,
        "h1" => "Aucun détail trouvé"
    ]);
}
 // Récupérer l'identifiant de réservation
//  $booking_id = null;
 foreach ($booking_id as $item) {
     if (isset($item['booking_id'])) {
         $booking_id = $item['booking_id'];
         break;
     }
 }
    // Vérifier si l'identifiant de réservation est valide
    if ($booking_id === null) 
    {
        // Handle missing booking ID
        return $this->render("details/form_details2.php", [
            "details" => null,
            "h1" => "Erreur : réservation non trouvée"
        ]);
    }
       

        // Créer les détails
        $detailsCreated = $this->detailsManager->createDetail($id_user,$booking_id);
        debug($detailsCreated);  
        

        // Vérifie si les détails ont été créés avec succès avant de les passer à la vue
        if ($detailsCreated ) 
        {
            // modif ici

            // $details = $this->detailsRepository->findDetailByRoomId($room_id);
            $details = $this->detailsRepository->findDetailByBookingId($booking_id);

            debug($details);
            if ($details !== null) 
            {
                return $this->render("details/form_details2.php", [
                    "details" => $details,
                    "h1" => "Facture"
                ]);  
            } else {

                return $this->render("details/form_details2.php", [
                    "details" => null,
                    "h1" => "Aucun détail trouvé"
                ]);
            } 
        } 
       
    }

    // public function newDetail2()
    // {
    //     $details = $this->detailsRepository->findDetail($this->details);
    //     return $this->render("details/form_details2.php", [
    //         "details" => $details,
    //         "h1" => "Facture"
    //     ]);  

    // }
}
