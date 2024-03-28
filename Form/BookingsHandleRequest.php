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

        // Convertir $user_id en entier
        $user_id = intval($user_id); 

        // Vérifier si le formulaire est soumis
        if (isset($_POST['book'])&& $user_id !== 0) {
             // Utiliser $user_id pour définir la propriété user_id de l'objet Bookings
    
            extract($_POST);
            // d_die($_POST);
            // d_die($_SESSION);

            // S'assurer que l'utilisateur est connecté
            if (!$user_id) {
                $errors[] = "Merci de vous connecter avant de faire une réservation.";
            } else {
                // Définir directement la valeur de user_id à partir de la session
                $bookings->setUser_id($user_id);
                // d_die($bookings->setUser_id($user_id));

                $totalPrice = 0;
                // Traiter chaque réservation dans le panier
                foreach ($_SESSION['cart'] as $reservation) {
     
                    // Calcul du prix total des réservations dans le panier
                    // Convertir le prix en float
                    $price = floatval($reservation['room']->getPrice()); 
                    $totalPrice += $price;
                }

                d_die($bookings->setBooking_price($totalPrice));
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
    
}