<?php

namespace Form;

use Model\Entity\Detail;
use Model\Repository\DetailRepository;

class DetailHandleRequest extends BaseHandleRequest
{
    private $detailRepository;

    // const ROOM_ID = 'room_id';
    // const BOOKING_ID = 'booking_id';
    // const START_DATE = 'booking_start_date';
    // const END_DATE = 'booking_end_date';

    public function __construct()
    {
        $this->detailRepository = new DetailRepository;
    }

    public function handleFormDetail(Detail $detail)
    {
    // d_die($_POST);

        if (isset($_POST['submit'])) {

            extract($_POST);
            $errors = [];

            // converti en date en seconde avec strtotime depuis le 1janvier 1960         
            // $booking_start_date = date("Y-m-d", strtotime($_POST['booking_start_date']));
            // $booking_end_date = date("Y-m-d", strtotime($_POST['booking_end_date']));
            $booking_start_date = date("Y-m-d", strtotime($booking_start_date));
            $booking_end_date = date("Y-m-d", strtotime($booking_end_date));
            // d_die($booking_start_date);

            // Calculer la durée de la réservation en jours
            $duration = strtotime($booking_end_date) - strtotime($booking_start_date);
            // Nombre de secondes dans une journée
            $nbDays = $duration / 86400; 
            }
            // date du jour
            $today = time();

            // Vérification de la validité du formulaire
            if (empty($booking_start_date)) {
                $errors[] = "La date de début ne peut pas être vide";
                }

            if (empty($booking_end_date)) {
                $errors[] = "La date de fin ne peut pas être vide";
                }

            // // Est-ce que room_id ,booking_start_date et booking_end_date existe déjà dans la bdd ?

            // $request = $this->detailRepository->findByAttributes($detail,
            // [self::START_DATE => $booking_start_date,self::END_DATE => $booking_end_date,self::ROOM_ID => $_POST['room_id']
            // ]);
            $request = $this->detailRepository->findByAttributes($detail, [
                'booking_start_date' => $booking_start_date,
                'booking_end_date' => $booking_end_date,
                // Assurez-vous que $id_room est défini
                'room_id' => $id_room 
            ]);

            if ($request) {
                $errors[] = "La chambre n'est pas disponible pour cette période";
            }
            
            // si $today est > a la date de début de réservation ou $today est > à la date de fin de réservation  
            if (strtotime($today) > strtotime($_POST['booking_start_date']) || strtotime($today) > strtotime($_POST['booking_end_date'])) {
            if ($todayDate > $_POST['booking_start_date'] || $todayDate > $_POST['booking_end_date']) {

                $errors[] = "votre date de début ou de fin de réservation ne peut pas être inférieur à la date d'aujourd'hui";
            } 

            // Si aucune erreur, définir les propriétés de l'entité
            if (empty($errors)) {             
                $detail->setRoom_id($id_room);
                $detail->setBooking_id($booking_id);
                $detail->setBooking_start_date($booking_start_date);
                $detail->setBooking_end_date($booking_end_date);
    
                // d_die($_POST); 
                return true;
            }
            // Gère les erreurs
            $this->setEerrorsForm($errors);
 
            // d_die($_POST); 
            $errors[] = "Des données obligatoires sont manquantes dans le formulaire.";    
        }
    }
}