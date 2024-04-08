<?php

namespace Service;

use Model\Entity\Details;
use Model\Repository\DetailsRepository;
use Model\Repository\BookingsRepository;

class DetailsManager{

    private DetailsRepository $detailsRepository;
    private BookingsRepository $bookingsRepository;

    public function __construct()
    {
        $this->detailsRepository = new DetailsRepository;
        $this->bookingsRepository = new BookingsRepository;
    }

    public function createDetail($id_user)
    {
        // d_die($id_user);
        // Vérification de l'existence de la session et initialisation des variables
        $id_user = $_SESSION['users']->getId_user() ?? null;
    // d_die($id_user);

        $bookingStartDate = null;
        $bookingEndDate = null;
        $room_id = null;    
        
        // Récupération des valeurs depuis la session
        if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $item) {
                if (isset($item['date_debut'])) {
                    $bookingStartDate = $item['date_debut'];
                }
                // d_die($bookingStartDate);

                if (isset($item['date_fin'])) {
                    $bookingEndDate = $item['date_fin'];
                }
                if (isset($item['room']) && is_object($item['room']) && method_exists($item['room'], 'getId_room')) {
                    $room_id = $item['room']->getId_room();
                    // d_die($room_id);
                    break;
                     // Sort de la boucle dès qu'on trouve la valeur de id_room
                }
            }
        }
        // d_die($_SESSION);
        // d_die($room_id);
        // d_die($bookingStartDate);
        // d_die($bookingEndDate);
        // d_die($id_user);

        // Vérifier si la réservation existe par rapport a l'id de l'utilisateur
        $bookings = $this->bookingsRepository->findUserBookings($id_user);
// d_die($bookings);
        if (!$bookings) {
            // Gérer le cas où la réservation n'existe pas
            return false;
        }
        // Créer un nouvel objet Detail
        $details = new Details();
// d_die($details);
        $details->setBooking_id($bookings->getId_booking());
// d_die($details);
        $details->setRoom_id($room_id);
// d_die($details);
        $details->setBooking_start_date($bookingStartDate);
        $details->setBooking_end_date($bookingEndDate);
// d_die($details);
        $details->setBooking_price($bookings->getBooking_price());
// d_die($details);
        // Insérer le détail dans la base de données
        $success = $this->detailsRepository->insertDetail($details);
// d_die($details);
            if ($success) {
                // Récupérer les détails créés dans la base de données
                $createdDetails = $this->detailsRepository->findDetailById($details->getBooking_id()); // Remplacez cette ligne par la méthode adéquate pour récupérer les détails créés
            
                return $createdDetails; // Retourner les détails créés
            } else {
                return false;
            }
    }

}