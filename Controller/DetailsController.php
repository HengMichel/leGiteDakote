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
        // debug($_SESSION);
        // debug($_POST);
        // debug($_SESSION['cart']);
        // Récupérer l'identifiant de l'utilisateur à partir de la session ou d'où il est disponible
        $id_user = $_SESSION['users']->getId_user() ?? null;
        // debug($id_user);

        // Récupérer les réservations de l'utilisateur à partir de la session
        $bookings = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
        // debug($bookings);

        // Vérifier si le panier contient des réservations
        if (empty($bookings)) 
        {
           return $this->render("details/form_details2.php", [
               "details" => null,
               "h1" => "Aucun détail trouvé"
           ]);
        }
       
        // Créer détails dans la bdd
        $createdDetails = $this->detailsManager->createDetail($id_user,$bookings);
        // debug($createdDetails);  

        if ($createdDetails !== null) 
        {
            // Stocker l'ID de la réservation pour l'utiliser après la redirection
            $_SESSION['last_booking_id'] = $createdDetails->getBooking_id();

            // Redirection après l'insertion pour éviter les doubles soumissions
            return $this->render("details/form_details2.php", [
                "details" => $createdDetails,
                "h1" => "Votre facture"
            ]); 
            exit();
        } else 
        {
            return $this->render("details/form_details2.php", [
                "details" => null,
                "h1" => "Aucun détail trouvé"
            ]);
        } 
    } 
}

  
