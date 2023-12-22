<?php

namespace Form;

use Model\Entity\Bookings;
use Model\Repository\BookingsRepository;


class BookingsHandleRequest extends BaseHandleRequest
{
    private $bookingsRepository;

    const START_DATE = 'booking_start_date';
    const END_DATE = 'booking_end_date';
    const ROOM_ID = 'room_id';
    const PRICE = 'price';



    public function __construct()
    {
        $this->bookingsRepository = new BookingsRepository;
    }

    public function handleForm(Bookings $bookings)
    {
        // d_die($_POST);
        if (isset($_POST['book'])) {

            extract($_POST);
            $errors = [];

            // Vérifiez si les clés nécessaires existent dans $_POST
            // if (!isset($_POST[self::START_DATE], $_POST[self::END_DATE], $_POST[self::PRICE], $_POST[self::ROOM_ID])) {

            // convertir en date en seconde avec strtotime depuis le 1janvier 1960         
            $booking_start_date = date("d-m-Y", strtotime($_POST[self::START_DATE]));
            $booking_end_date = date("d-m-Y", strtotime($_POST[self::END_DATE]));
            // d_die($booking_start_date);

            $duration = strtotime($_POST[self::END_DATE]) - strtotime($_POST[self::START_DATE]);
            $nbDays = $duration / 86400;
            $totalPrice = $_POST[self::PRICE] * $nbDays;

            // date du jour
            $today = date("Ymd");

            // Vérification de la validité du formulaire
             if (empty($booking_start_date)) {
                $errors[] = "La date de début ne peut pas être vide";
                }

            if (empty($booking_end_date)) {
                $errors[] = "La date de fin ne peut pas être vide";
                }

            // Est-ce que room_id ,booking_start_date et booking_end_date existe déjà dans la bdd ?
            $request = $this->bookingsRepository->findByAttributes($bookings,
            [self::START_DATE => $booking_start_date],[self::END_DATE => $booking_end_date]);
            
            // si $today est > a la date de début de réservation ou $today est > à la date de fin de réservation  
            if (strtotime($today) > strtotime($_POST[self::START_DATE]) || strtotime($today) > strtotime($_POST[self::END_DATE])) {
    
                $errors[] = "votre date de début ou de fin de réservation ne peut pas être inférieur à la date d'aujourd'hui";
                } else{ 
                if($bookings->getUser_id() == null){

                    $errors[] = "Merci de vous connectez avant toute réservation";
                    }
                }

            // Si aucune erreur, définir les propriétés de l'entité
            if (empty($errors)) {             
                $bookings->setRoom_id($_POST[self::ROOM_ID]);
                $bookings->setBooking_start_date($booking_start_date);
                $bookings->setBooking_end_date($booking_end_date);
                $bookings->setBooking_price($_POST[self::PRICE]);
                
                // d_die($_POST); 
                return true;
                }
                // Gérer les erreurs
                $this->setEerrorsForm($errors);
 
            } else {
                // d_die($_POST); 
                $errors[] = "Des données obligatoires sont manquantes dans le formulaire.";
            }      
    
    }
    
    

    public function handleSecurity()
    {
       
        
    }
}