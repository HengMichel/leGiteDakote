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

            extract($_POST);
            $errors = [];

            // Vérification de la validité du formulaire

            if (empty($booking_start_date)) {
                    $errors[] = "Le booking_start_date ne peut pas être vide";
                }
            
            if (empty($booking_end_date)) {
                    $errors[] = "Le booking_end_date ne peut pas être vide";
                }

            
                





                $requiredFields = ['room_id', 'booking_price', 'booking_start_date', 'booking_end_date'];

                foreach ($requiredFields as $field) {
                    if (empty($data[$field])) {
                        $errors[] = ucfirst($field) . " ne peut pas être vide";
                    }
                }
        
                if (!empty($data['booking_start_date']) && !empty($data['booking_end_date'])) {
                    $today = date("Y-m-d");
                // si $today est > a la date de début de réservation ou $today est > à la date de fin de réservation ou > a la date fin
                    if ($today > $data['booking_start_date'] || $today > $data['booking_end_date']) {
                        $errors[] = "La date de début ou de fin de réservation ne peut pas être inférieure à la date d'aujourd'hui";
                    }
                }
        
                return $errors;
    





        
           
            if (empty($errors)) {
              
                $bookings->setRoom_id($room_id);
                $bookings->setBooking_price($booking_price);
                $bookings->setBooking_start_date($booking_start_date);
                $bookings->setBooking_end_date($booking_end_date);
                $bookings->setBooking_end_date($booking_end_date);
                $bookings->setBooking_start_date($booking_start_date);
                return true;
            }

            $this->setEerrorsForm($errors);
        }

    }

    public function handleSecurity()
    {
       
        
    }
}