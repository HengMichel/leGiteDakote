<?php

namespace Controller;

use Service\DetailsManager;
use Controller\BaseController;
use Model\Entity\Details;

class DetailsController extends BaseController
{
    private $detailsManager;
    private $details;

    public function __construct()
    {
        $this->detailsManager = new DetailsManager;
        $this->details = new Details;
    }

    public function newDetail()
    {
        // debug($_SESSION);
        // debug($_POST);
        // debug($_SESSION['cart']);
        // Récupérer l'identifiant de l'utilisateur à partir de la session ou d'où il est disponible
        $id_user = $_SESSION['users']->getId_user() ?? null;
        // debug($id_user);
        // echo "Utilisateur identifié : $id_user"; // Point de débogage

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
       
        // Créer détails dans la bdd
        $createdDetails = $this->detailsManager->createDetail($this->details);
// debug($createdDetails);  

        if ($createdDetails !== null) 
        {
            return $this->render("details/form_details2.php", [
                "details" => $createdDetails,
                "h1" => "Facture"
            ]);  
        } else 
        {
            return $this->render("details/form_details2.php", [
                "details" => null,
                "h1" => "Aucun détail trouvé"
            ]);
        } 
    } 
}

  
