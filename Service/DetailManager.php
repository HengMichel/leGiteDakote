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
        // d_die($id);
        // Initialisation des variables
        $bookingStartDate = null;
        $bookingEndDate = null;
        $room_id = null;

        // Récupération des valeurs depuis la session
        if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $item) {
                if (isset($item['date_debut'])) {
                    $bookingStartDate = $item['date_debut'];
                }
                if (isset($item['date_fin'])) {
                    $bookingEndDate = $item['date_fin'];
                }
                if (isset($item['room']) && is_object($item['room']) && method_exists($item['room'], 'getId_room')) {
                    $room_id = $item['room']->getId_room();
                    break;
                     // Sort de la boucle dès qu'on trouve la valeur de id_room
                }
            }
        }
        // d_die($_SE:SSION);
        // d_die($room_id);
        // d_die($bookingStartDate);
        // d_die($bookingEndDate);

        $booking = $this->bookingsRepository->findUserBookings($id);
    // d_die($booking);
        if (!$booking) {
            // Gérer le cas où la réservation n'existe pas
            return false;
        }

        // Obtenez l'ID de la réservation
    $booking_id = $booking;
d_die($booking_id);
        // Créer un nouvel objet Detail
        $detail = new Detail();
        $detail->setBooking_id($booking_id);
    // d_die($detail);
        $detail->setRoom_id($room_id);
        $detail->setBooking_start_date($bookingStartDate);
        $detail->setBooking_end_date($bookingEndDate);
        // d_die($detail);

        // $this->detailRepository->insertDetail($detail);

        return true;
    }
}