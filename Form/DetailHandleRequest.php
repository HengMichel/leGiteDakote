<?php

namespace Form;

use DateTime;
use Model\Entity\Detail;
use Model\Repository\BookingsRepository;

class DetailHandleRequest extends BaseHandleRequest
{
    private $bookingsRepository;

    const START_DATE = 'booking_start_date';
    const END_DATE = 'booking_end_date';
    const ROOM_ID = 'id_room';
    const PRICE = 'price';

    public function __construct()
    {
        $this->bookingsRepository = new BookingsRepository;
    }

    public function handleFormDetail(Detail $detail, $room_id)
    {
// d_die($_POST);
// d_die($_POST['booking_start_date']);

        if (isset($_POST['passerLaCommande'])) {
// d_die($_POST);
// d_die($_POST['booking_start_date']);

            extract($_POST);
            $errors = [];

            // Convertit les dates en secondes depuis le 1er janvier 1970
            // $booking_start_date = date("Y-m-d", strtotime($booking_start_date));
            // $booking_end_date = date("Y-m-d", strtotime($booking_end_date));
// d_die($booking_start_date);

            // Convertit les dates en objets DateTime
            $startDateTime = new DateTime($booking_start_date);
            $endDateTime = new DateTime($booking_end_date);

            // date du jour
            // $today = time();
            $today = new DateTime();

// ne fait pas le calcul problème a résoudre #####################
            // Calcule la durée de la réservation en jours
            $duration = strtotime($booking_end_date) - strtotime($booking_start_date);
            // d_die($duration);
            // Nombre de secondes dans une journée
            $nbDays = $duration / 86400; 
// ###############################################################
// d_die($nbDays);

          



// Vérifie si la date de début de réservation est antérieure à la date actuelle
            // if ($booking_start_date < $today) {
            if ($startDateTime < $today) {

                $errors[] = "La date de début de réservation ne peut pas être antérieure à la date d'aujourd'hui.";
            }
// d_die($errors);
        // Vérifie si la date de fin de réservation est antérieure à la date actuelle
            // if ($booking_end_date < $today) {
            if ($endDateTime < $today) {

                $errors[] = "La date de fin de réservation ne peut pas être antérieure à la date d'aujourd'hui.";
            }
// d_die($errors);

// d_die($endDateTime < $today);
        // Vérifie si la date de début de réservation est postérieure à la date de fin de réservation
        // if ($booking_start_date > $booking_end_date) {
            if ($startDateTime > $endDateTime) {

                $errors[] = "La date de début de réservation ne peut pas être postérieure à la date de fin de réservation.";
            }

             // Si des erreurs sont trouvées
             if (!empty($errors)) {
                // Gère les erreurs
                $this->setEerrorsForm($errors);

                // d_die($_POST[self::ROOM_ID]);
 // Redirigez l'utilisateur vers la page précédente avec l'identifiant de la chambre
 
// ici si je décommente je reste sur la meme page mais sinon je suis redirigé http://localhost/leGiteDakote/detail/newDetail

                // return redirection(addLink("rooms", "show", $_POST[self::ROOM_ID]));
            }


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
            // }


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
}
