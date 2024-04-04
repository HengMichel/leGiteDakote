<?php

namespace Service;

use Model\Entity\Detail;
use Model\Repository\DetailRepository;
use Model\Repository\BookingsRepository;

class DetailManager{

    private DetailRepository $detailRepository;
    private BookingsRepository $bookingsRepository;

    public function __construct()
    {
        $this->detailRepository = new DetailRepository;
        $this->bookingsRepository = new BookingsRepository;
    }

    public function createDetail($id)
    {
        // Vérification de l'existence de la session et initialisation des variables
        $id_user = $_SESSION['users']->getId_user() ?? null;
        $bookingStartDate = null;
        $bookingEndDate = null;
        $room_id = null;    
// d_die($id_user);
        
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
        $bookings = $this->bookingsRepository->findUserBookings($id);
d_die($bookings);
        if (!$bookings) {
            // Gérer le cas où la réservation n'existe pas
            return false;
        }
        // Créer un nouvel objet Detail
        $detail = new Detail();
        $detail->setBooking_id($bookings->getId_booking());
// d_die($detail);
        $detail->setRoom_id($room_id);
// d_die($detail);
        $detail->setBooking_start_date($bookingStartDate);
        $detail->setBooking_end_date($bookingEndDate);
// d_die($detail);
        try {
            // Insérer le détail dans la base de données
            $success = $this->detailRepository->insertDetail($detail);
            return $success;
        } catch (\PDOException $e) {
            // Gérer les erreurs PDO
            error_log("PDOException in createDetail: " . $e->getMessage());
            return false;
        }
    }
}