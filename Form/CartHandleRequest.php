<?php

namespace Form;

use Model\Entity\Details;

class CartHandleRequest extends BaseHandleRequest
{
    const ROOM_ID = 'room_id';
    const BOOKING_ID = 'booking_id';
    const START_DATE = 'booking_start_date';
    const END_DATE = 'booking_end_date';

    public function handleFormCart(Details $details)
    {
        // d_die($_POST);
        if (isset($_POST['panier'])) 
        {
            extract($_POST);
            $errors = [];
            // converti en date en seconde avec strtotime depuis le 1janvier 1960         
            $booking_start_date = date("Y-m-d", strtotime($_POST[self::START_DATE]));
            $booking_end_date = date("Y-m-d", strtotime($_POST[self::END_DATE]));
            // d_die($booking_start_date);
            // Calculer la durée de la réservation en jours
            $duration = strtotime($booking_end_date) - strtotime($booking_start_date);
            // Nombre de secondes dans une journée
            $nbDays = $duration / 86400; 
        }
        // date du jour
        $todayDate = time();

        // Si aucune erreur, définir les propriétés de l'entité
        if (empty($errors)) 
        {             
            $details->setRoom_id($_POST[self::ROOM_ID]);
            $details->setBooking_id($_POST[self::BOOKING_ID]);
            $details->setBooking_start_date($booking_start_date);
            $details->setBooking_end_date($booking_end_date);
            // d_die($details); 
            return true;
        }
        // Gère les erreurs
        $this->setEerrorsForm($errors);
        $errors[] = "Des données obligatoires sont manquantes dans le formulaire.";      
    }
}