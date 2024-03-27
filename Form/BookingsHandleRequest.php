<?php
namespace Form;

use Model\Entity\Bookings;
use Model\Repository\BookingsRepository;

class BookingsHandleRequest extends BaseHandleRequest
{
    private $bookingsRepository;

    const START_DATE = 'booking_start_date';
    const END_DATE = 'booking_end_date';
    const USER_ID = 'user_id';
    const ROOM_ID = 'room_id';

// type string
    const PRICE = 'price';
// ####################
    public function __construct()
    {
        $this->bookingsRepository = new BookingsRepository;
    }

    public function handleForm(Bookings $bookings, $user_id)
    {
// d_die($_SESSION);
// d_die($_POST); 
        $errors = [];

        // Vérifier si le formulaire est soumis
        if (isset($_POST['book'])) {
            extract($_POST);
            // d_die($_POST);
            // d_die($_SESSION);

            // S'assurer que l'utilisateur est connecté
            if (!$user_id) {
                $errors[] = "Merci de vous connecter avant de faire une réservation.";
            } else {
                // Définir directement la valeur de user_id à partir de la session
                $bookings->setUser_id($user_id);
                // d_die($bookings);

                $totalPrice = 0;
                // Traiter chaque réservation dans le panier
                foreach ($_SESSION['cart'] as $reservation) {
     
                    // Calcul du prix total des réservations dans le panier
                    // Convertir le prix en float
                    $price = floatval($reservation['room']->getPrice()); 
                    $totalPrice += $price;
                }
                // Définir le prix total et l'état de réservation
                $bookings->setBooking_price($totalPrice);
                $bookings->setBooking_state($_POST['booking_state']);
                // d_die($bookings);

                // Retourne true pour indiquer que le formulaire a été traité avec succès
                return true;
            }
        } 
        // Gère les erreurs
        $this->setEerrorsForm($errors);
        // d_die($_POST); 
        $errors[] = "Des données obligatoires sont manquantes dans le formulaire.";
        return false;                   
        }

//###################### gestion de la date ##############################
            // converti en date en seconde avec strtotime depuis le 1janvier 1960         
            // $booking_start_date = date("Y-m-d", strtotime($_POST[self::START_DATE]));
            // $booking_end_date = date("Y-m-d", strtotime($_POST[self::END_DATE]));
            // d_die($booking_start_date);

// Ajoute les valeurs des dates de début et de fin dans l'objet $bookings
            // $bookings->setBooking_start_date($booking_start_date);
            // $bookings->setBooking_end_date($booking_end_date);

// Calculer la durée de la réservation en jours
            // $duration = strtotime($booking_end_date) - strtotime($booking_start_date);
            // Nombre de secondes dans une journée
            // $nbDays = $duration / 86400; 
    // Vérification de la validité du formulaire
            // if (empty($booking_start_date)) {
            //     $errors[] = "La date de début ne peut pas être vide";
            //     }

            // if (empty($booking_end_date)) {
            //     $errors[] = "La date de fin ne peut pas être vide";
            //     }

            // Est-ce que user_id ,booking_start_date et booking_end_date existe déjà dans la bdd ?
            // $request = $this->bookingsRepository->findByAttributes($bookings,
            // [self::START_DATE => $booking_start_date,self::END_DATE => $booking_end_date,self::USER_ID => $_POST[self::USER_ID]]);

            // if ($request) {
            //     $errors[] = "La chambre n'est pas disponible pour cette période";
            // }
            
            // si $today est > a la date de début de réservation ou $today est > à la date de fin de réservation  
            // if (strtotime($today) > strtotime($_POST[self::START_DATE]) || strtotime($today) > strtotime($_POST[self::END_DATE])) {
            //     if ($todayDate > $_POST[self::START_DATE] || $todayDate > $_POST[self::END_DATE]) {

            //         $errors[] = "votre date de début ou de fin de réservation ne peut pas être inférieur à la date d'aujourd'hui";
            //     } else{ 
// ##############################################################################
    
    
    public function cancelPanier($idBooking)
    {
         // Vérifier si la réservation existe dans le panier de la session
        if (isset($_SESSION['panier']) && is_array($_SESSION['panier'])) {
        // Parcourir le panier pour trouver la réservation à annuler
            foreach ($_SESSION['panier'] as $key => $item) {
            // Vérifier si l'élément est une réservation et correspond à l'ID   fourni
                if (is_array($item) && isset($item['booking_id']) && $item['booking_id'] == $idBooking) {
                // Supprimer la réservation du panier
                unset($_SESSION['panier'][$key]);
                // Sortir de la boucle une fois la réservation annulée
                break;
                }
            }
        }
    }

    public function annulerPanier() {
        d_die($_GET['id_booking']);
        // Vérifier si un ID de réservation est fourni dans l'URL
        if (isset($_GET['id_booking'])) {
            // Récupérer l'ID de la réservation depuis l'URL
            $idPanier = $_GET['id_booking'];
            
            // Annuler la réservation en appelant la fonction cancelBooking
            $this->cancelPanier($idPanier);
        }
    }
    
}