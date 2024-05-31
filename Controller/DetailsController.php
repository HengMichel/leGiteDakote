<?php

namespace Controller;

use Service\DetailsManager;
use Controller\BaseController;
use Model\Entity\Details;
use Model\Repository\DetailsRepository;

class DetailsController extends BaseController
{
    private $detailsManager;
    private $detailsRepository;
    private $details;

    public function __construct()
    {
        $this->detailsManager = new DetailsManager;
        $this->detailsRepository = new DetailsRepository;
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
        // $createdDetails = $this->detailsManager->createDetail($this->details);
        $createdDetails = $this->detailsManager->createDetail($id_user,$bookings);
// debug($createdDetails);  

        if ($createdDetails !== null) 
        {
            // return $this->render("details/form_details2.php", [
            //     "details" => $createdDetails,
            //     "h1" => "Facture"
            // ]);  
             // Supprimer les variables de session spécifiques à la facture
        $sessionKeysToUnset = ['totalPrice', 'cart', 'room_id'];
        foreach ($sessionKeysToUnset as $key) 
        {
            unset($_SESSION[$key]);
        }

        // Stocker l'ID de la réservation pour l'utiliser après la redirection
        $_SESSION['last_booking_id'] = $createdDetails->getBooking_id();

        // Redirection après l'insertion pour éviter les doubles soumissions
        return redirection(addLink("details","confirmation"));
        exit();

        } else 
        {
            return $this->render("details/form_details2.php", [
                "details" => null,
                "h1" => "Aucun détail trouvé"
            ]);
        } 
    } 

    public function confirmation()
{
    // Récupérer l'ID de la dernière réservation depuis la session
    $lastBookingId = $_SESSION['last_booking_id'] ?? null;

    if ($lastBookingId) 
    {
        // Récupérer les détails de la réservation en utilisant l'ID de réservation
        $bookingDetails = $this->detailsRepository->findDetailByBookingId($lastBookingId);

        return $this->render("details/confirmation.php", [
            "details" => $bookingDetails,
            "h1" => "Confirmation de réservation"
        ]);
    } 
    else 
    {
        return $this->render("details/confirmation.php", [
            "details" => null,
            "h1" => "Aucune réservation trouvée"
        ]);
    }
}

}

  
