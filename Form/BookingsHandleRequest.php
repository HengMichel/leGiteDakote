<?php

namespace Form;

use Model\Entity\Bookings;
use Model\Repository\BookingsRepository;


class BookingsHandleRequest extends BaseHandleRequest
{
    private $bookingsRepository;

    public function __construct()
    {
        $this->bookingsRepository  = new BookingsRepository;
    }

    public function handleForm(Bookings $bookings)
    {
        if (isset($_POST['book'])) {

            // Extraction des données POST
            extract($_POST);

            // Initialisation du tableau d'erreurs
            $errors = [];

            // Vérification de la validité du formulaire
            if (empty($booking_start_date)) {
                    $errors[] = "Le booking_start_date ne peut pas être vide";
                }
            
            if (empty($booking_end_date)) {
                    $errors[] = "Le booking_end_date ne peut pas être vide";
                }
            // Est-ce que la date de debut et de fin de la  reservation l'id de la chambre existe déjà dans la bdd ?
            $request = $this->bookingsRepository->findByAttributes($bookings, ["booking_start_date" =>  $booking_start_date] , $bookings,["booking_end_date" =>$booking_end_date]);    
            if ($request) {
                $errors[] = "La date de debut et de fin de la  reservation de la chambre est déjà prise, veuillez en choisir un nouvelle date";
            }

            // $requiredFields = ['room_id', 'booking_price', 'booking_start_date', 'booking_end_date'];

            // foreach ($requiredFields as $field) {
            //     if (empty(${$field}) || ${$field} === null){
            //         $errors[] = ucfirst($field) . " ne peut pas être vide ou nul";
            //         }
            //     }
        
            // Vérification des dates
            // if (!empty($booking_start_date) && !empty($booking_end_date)) {
            //     $today = date("Y-m-d");

                // si $today est > a la date de début de réservation ou $today est > à la date de fin de réservation ou > a la date fin       
                // if ($today > $booking_start_date || $today > $booking_end_date) {
                //     $errors[] = "La date de début ou de fin de réservation ne peut pas être inférieure à la date d'aujourd'hui";
                //     }
                // }
        
            // Si des erreurs sont détectées, on les retourne
            if (!empty($errors)) {
                return $errors;
            }
   
            // Aucune erreur, on met à jour les propriétés de l'objet $bookings
            if (empty($errors)) {      
                $bookings->setBooking_start_date($booking_start_date);
                $bookings->setBooking_end_date($booking_end_date);
                $bookings->setUser_id($user_id);
                $bookings->setRoom_id($room_id);
                $bookings->setBooking_price($booking_price);
                $bookings->setBooking_state($booking_state);
                return true;
            }

            $this->setEerrorsForm($errors);
        }

    }

    public function handleSecurity()
    {
       
        
    }
}