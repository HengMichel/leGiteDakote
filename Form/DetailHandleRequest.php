<?php

namespace Form;

use DateTime;
use Model\Entity\Detail;
use Model\Repository\DetailRepository;
use Model\Repository\BookingsRepository;

class DetailHandleRequest extends BaseHandleRequest
{
    // private $bookingsRepository;
    private $detailRepository;

    const START_DATE = 'booking_start_date';
    const END_DATE = 'booking_end_date';
    const ROOM_ID = 'id_room';
    const PRICE = 'price';

    public function __construct()
    {
        // $this->bookingsRepository = new BookingsRepository;
        $this->detailRepository = new DetailRepository;
    }

    // public function handleFormDetail(Detail $detail, $room_id)
    public function handleFormDetail(Detail $detail)
    {
        d_die($_POST);
        // if (isset($_POST['passerLaCommande'])) {
        // if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // d_die($_POST);

            extract($_POST);
            $errors = [];

            // Convertit les dates en objets DateTime
            $startDateTime = new DateTime($booking_start_date);
            $endDateTime = new DateTime($booking_end_date);
            // d_die($startDateTime);

            // date du jour
            $today = new DateTime();
            // d_die($today);

            // Vérifie si la date de début de réservation est antérieure à la date actuelle
            if ($startDateTime->getTimestamp() < $today->getTimestamp()) {

                $errors[] = "La date de début de réservation ne peut pas être antérieure à la date d'aujourd'hui.";
            }
            // Vérifie si la date de fin de réservation est antérieure à la date actuelle
            if ($endDateTime->getTimestamp() < $today->getTimestamp()) {

                $errors[] = "La date de fin de réservation ne peut pas être antérieure à la date d'aujourd'hui.";
            }

            // Vérifie si la date de début de réservation est postérieure à la date de fin de réservation
            if ($startDateTime->getTimestamp() > $endDateTime->getTimestamp()) {

                $errors[] = "La date de début de réservation ne peut pas être postérieure à la date de fin de réservation.";
            }

            // Calculer le nombre de jours de réservation
            $interval = $startDateTime->diff($endDateTime);
            $nbDays = $interval->days;

            // Vérifier si la réservation est pour plusieurs jours
            if ($nbDays > 0) {
                // Traiter chaque jour de la réservation
                $currentDate = $startDateTime;
                for ($i = 0; $i < $nbDays; $i++) {    
                    // Incrémenter la date actuelle pour passer au jour suivant
                    $currentDate->modify('+1 day');
                    // d_die($nbDays);
                }
            } else {
                // Si la réservation ne concerne qu'un seul jour, traiter la réservation normalement
                // $this->insertDetail($detail, $room_id, $startDateTime);

                

//################### a verifier ##########################               // 
                // $detail->setId_detail($id);
            }
// #########################################################
             




// // Est-ce que room_id ,booking_start_date et booking_end_date existe déjà dans la bdd dans bookings?

            // $request = $this->bookingsRepository->findByAttributes($detail, [
            //     'booking_start_date' => $booking_start_date,
            //     'booking_end_date' => $booking_end_date,
            //     'room_id' => $room_id 
            // ]);


            // $request = $this->bookingsRepository->findByAttributes($detail,
            // [self::START_DATE => $booking_start_date,self::END_DATE => $booking_end_date]);
            // [self::START_DATE => $startDateTime->format('Y-m-d'),
            // self::END_DATE => $endDateTime->format('Y-m-d')]);
// d_die($request);            
            // if ($request) {
            //     $errors[] = "La chambre n'est pas disponible pour cette période";
           


            // Vérifie si la chambre est disponible pour la période spécifiée
            $bookingsRepository = new BookingsRepository();
            $existingBookings = $bookingsRepository->findBookingsForDetail($detail);
// d_die($detail);
            // Si des réservations existent pour cette période, la chambre n'est pas disponible
            if (!empty($existingBookings)) {
                $errors[] = "La chambre n'est pas disponible pour cette période.";
            }


// ############################################################################




            // si $today est > a la date de début de réservation ou $today est > à la date de fin de réservation  
            // if (strtotime($today) > strtotime($_POST['booking_start_date']) || strtotime($today) > strtotime($_POST['booking_end_date'])) {
            //     if ($todayDate > $_POST['booking_start_date'] || $todayDate > $_POST['booking_end_date']) {

            //         $errors[] = "votre date de début ou de fin de réservation ne peut pas être inférieur à la date d'aujourd'hui";
            //     } 

             // si $today est > a la date de début de réservation ou $today est > à la date de fin de réservation  
// if (strtotime($today) > strtotime($_POST['booking_start_date']) || strtotime($today) > strtotime($_POST['booking_end_date'])) {
//     $errors[] = "votre date de début ou de fin de réservation ne peut pas être antérieure à la date d'aujourd'hui";
// }

// Si des erreurs sont trouvées
if (!empty($errors)) {
    // Gère les erreurs
    $this->setEerrorsForm($errors);
    return false;
}
   
// d_die($_POST);
            // Si aucune erreur, définir les propriétés de l'entité
            if (empty($errors)) {             
                // $detail->setRoom_id($room_id);
                // $detail->setBooking_id($booking_id);
                // $detail->setBooking_start_date($booking_start_date);
                // $detail->setBooking_end_date($booking_end_date);
    
// d_die($_POST); 
                return true;
            }

            
        }
    }
// }
