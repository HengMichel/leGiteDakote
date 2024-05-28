<?php

namespace Controller;

use Service\DetailsManager;
use Controller\BaseController;
use Model\Entity\Details;
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
        $this->details = new Details;
        // ##########################

    }
    public function newDetail()
    {
        // debug($_SESSION);
        // debug($_POST);
// debug($_SESSION['cart']);
        // Récupérer l'identifiant de l'utilisateur à partir de la session ou d'où il est disponible
        $id_user = $_SESSION['users']->getId_user() ?? null;
// debug($id_user);
echo "Utilisateur identifié : $id_user"; // Point de débogage

        // Récupérer les réservations de l'utilisateur à partir de la session
        $rooms = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
// debug($rooms);

 // Vérifier si le panier contient des réservations
 if (empty($rooms)) 
 {
    return $this->render("details/form_details2.php", [
        "details" => null,
        "h1" => "Aucun détail trouvé"
    ]);
}

 // Récupérer l'identifiant de réservation
//  $rooms = null;
//  foreach ($rooms as $item) {
//      if (isset($item['room'])) {
//          $rooms = $item['room'];
//          break;
//      }
//  }
//  debug($rooms);
 
       
 
        // Créer les détails
        $details = $this->details;$this->detailsManager->createDetail($details);
    // debug($details);  
        

        // Vérifie si les détails ont été créés avec succès avant de les passer à la vue
        if ($details ) 
        {
            // modif ici

            // $details = $this->detailsRepository->findDetailByRoomId($room_id);
            $details = $this->detailsRepository->findDetailByBookingId($rooms);

            // debug($details);
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
