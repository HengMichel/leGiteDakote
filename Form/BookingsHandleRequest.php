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

// type string
    const PRICE = 'price';
// ####################
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

            // converti en date en seconde avec strtotime depuis le 1janvier 1960         
            $booking_start_date = date("Y-m-d", strtotime($_POST[self::START_DATE]));
            $booking_end_date = date("Y-m-d", strtotime($_POST[self::END_DATE]));
            // d_die($booking_start_date);

            // Calculer la durée de la réservation en jours
            $duration = strtotime($booking_end_date) - strtotime($booking_start_date);
            // Nombre de secondes dans une journée
            $nbDays = $duration / 86400; 

            // Initialisez la variable $totalPrice à 0
            $totalPrice = 0;

            // Effectuez le calcul du prix total de la réservation
            if (!empty($_POST['price'])) {

                //converted price ("string") to float
                $pricePerDay = floatval($_POST['price']);
                $totalPrice = $pricePerDay * $nbDays;
            }
            // d_die($_POST['price']);                   
            $bookings->setBooking_price($totalPrice);
            
            // date du jour
            $todayDate = time();

            // Vérification de la validité du formulaire
             if (empty($booking_start_date)) {
                $errors[] = "La date de début ne peut pas être vide";
                }

            if (empty($booking_end_date)) {
                $errors[] = "La date de fin ne peut pas être vide";
                }

            // Est-ce que room_id ,booking_start_date et booking_end_date existe déjà dans la bdd ?
            $request = $this->bookingsRepository->findByAttributes($bookings,
            [self::START_DATE => $booking_start_date,self::END_DATE => $booking_end_date,self::ROOM_ID => $_POST[self::ROOM_ID]
            ]);
            if ($request) {
                $errors[] = "La chambre n'est pas disponible pour cette période";
            }
            
            // si $today est > a la date de début de réservation ou $today est > à la date de fin de réservation  
            // if (strtotime($today) > strtotime($_POST[self::START_DATE]) || strtotime($today) > strtotime($_POST[self::END_DATE])) {
            if ($todayDate > $_POST[self::START_DATE] || $todayDate > $_POST[self::END_DATE]) {


                $errors[] = "votre date de début ou de fin de réservation ne peut pas être inférieur à la date d'aujourd'hui";
                } else{ 

                // d_die($_SESSION);
// ###################  Si pas connecté ############################################### 
                // if($bookings->getUser_id() == null){
                //     $errors[] = "Merci de vous connectez avant toute réservation";
                //     }
// ####################################################################################
                }

            // Si aucune erreur, définir les propriétés de l'entité
            if (empty($errors)) {             
                $bookings->setRoom_id($_POST[self::ROOM_ID]);
                $bookings->setBooking_start_date($booking_start_date);
                $bookings->setBooking_end_date($booking_end_date);
                $bookings->setBooking_price($_POST['price']);
    
                // d_die($_POST); 
                return true;
                }
                // Gère les erreurs
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