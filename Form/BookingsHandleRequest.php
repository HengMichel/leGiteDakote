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
        // Vérifie si le formulaire est soumis et utilise $user_id pour définir la propriété user_id de l'objet Bookings
        if (isset($_POST['book']) && $user_id !== null) 
        {
            extract($_POST);
            $errors = [];
            // d_die($_POST);
            // d_die($_SESSION);
            // d_die($errors);
            // S'assurer que l'utilisateur est connecté
            if ($user_id !== null) 
            {   
                // Définir directement la valeur de user_id à partir de la session
                $bookings->setUser_id($user_id);
                // d_die($bookings);
                // Récupère le prix total de la session
                $totalPrice = $_SESSION['totalPrice'] ?? 0;
                // d_die($totalPrice);
                // d_die($bookings->setBooking_price($totalPrice));
                // Définir le prix total et l'état de réservation
                $bookings->setBooking_price($totalPrice);
                $bookings->setBooking_state($_POST['booking_state']);
                // d_die($bookings);
                // Retourne true pour indiquer que le formulaire a été traité avec succès
                return true;
            }
        } else 
        {
            $errors[] = "Pour tout paiment Merci de vous connecter.";
        } 
        // Gère les erreurs
        $this->setEerrorsForm($errors);
        $errors[] = "Des données obligatoires sont manquantes dans le formulaire.";
        // d_die($errors);
        return false;                   
    }  
}