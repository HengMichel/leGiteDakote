<?php

namespace Service;

use DateTime;
use Form\BaseHandleRequest;
use Model\Entity\Rooms;
use Model\Repository\RoomsRepository;

class CartManager
{
    private RoomsRepository $roomsRepository;

    public function __construct()
    {
        $this->roomsRepository = new RoomsRepository;
    }

    public function addCart($id){
        
        extract($_POST);

        $quantity = $_POST["qte"] ?? 1;
        $pr = $this->roomsRepository;
        /** @var Rooms */
        $room = $pr->findRoomsById($id);

        // Vérifier si les dates sont valides
        $today = new DateTime();
        $bookingStartDate = new DateTime($booking_start_date);
        $bookingEndDate = new DateTime($booking_end_date);

        if ($bookingStartDate < $today || $bookingEndDate < $today) {
            throw new \Exception("La date de début ou de fin de réservation ne peut pas être antérieure à la date d'aujourd'hui.");
        }
    
        if ($bookingEndDate <= $bookingStartDate) {
            throw new \Exception("La date de fin de réservation ne peut pas être antérieure à la date de début de réservation.");
        }
    
        if ($bookingStartDate > $bookingEndDate) {
            throw new \Exception("La date de début de réservation ne peut pas être postérieure à la date de fin de réservation.");
        }

        // Calcule le nombre de jours de réservation
        $nbDays = $bookingStartDate->diff($bookingEndDate)->days;

        // Vérifier si les dates de réservation sont valides
        if ($nbDays <= 0) {
            throw new \Exception("La date de fin de réservation ne peut pas être antérieure ou égale à la date de début de réservation.");
        }

        // Calcule le prix total en fonction du nombre de jours de réservation et de la quantité
        $totalPrice = $nbDays * $room->getPrice() * $quantity;
        // d_die($totalPrice);



        if(!isset($_SESSION["cart"])) {
            $_SESSION["cart"] = [];
        }
        
        // on récupère ce qu'il y a dans le cart en session
        $cart = $_SESSION["cart"]; 

        $roomDejaDanscart = false;
        foreach ($cart as $indice => $value) {
            if ($room->getId_room() == $value["room"]->getId_room()) {
                $cart[$indice]["quantity"] += $quantity;
                $roomDejaDanscart = true;
                break;  
                // pour sortir de la boucle foreach
            }
        }
        
        if (!$roomDejaDanscart) {
            $cart[] = ["quantity" => $quantity, "room" => $room, "date_debut" => $booking_start_date, "date_fin" => $booking_end_date, "total_price" => $totalPrice];  
            // on ajoute une value au cart => $cart est un array d'array
        }

        // Mets à jour le prix total avec la methode calculateTotalPrice()
        $this->calculateTotalPrice();

        // je remets $cart dans la session, à l'indice 'cart'
        $_SESSION["cart"] = $cart;  
        
        $nb = 0;
        foreach ($cart as $value){
            $nb += $value["quantity"];
        }
        $_SESSION["nombre"] = $nb;
        // Redirige vers le tableau de bord
        return redirection(addLink("cart","detailCart"));
    }

    public function cancelCart($roomId) {
        if(isset($_SESSION['cart'])) {
            foreach($_SESSION['cart'] as $key => $reservation) {
                if($reservation['room']->getId_room() == $roomId) {
                    unset($_SESSION['cart'][$key]);
                    break;
                }
            }
            // Recalcule le prix total après l'annulation avec la methode calculateTotalPrice()
            $this->calculateTotalPrice();
        }
        // Redirige l'utilisateur vers la page du panier après l'annulation
        return redirection(addLink("cart", "detailCart"));
    }

    public function calculateTotalPrice() {
        $totalPrice = 0.0;
    
        if(isset($_SESSION['cart'])) {
            foreach($_SESSION['cart'] as $reservation) {
                $totalPrice += $reservation['room']->getPrice() * $reservation['quantity'];
            }
        }
    
        // Mets à jour le prix total dans la session
        $_SESSION['totalPrice'] = $totalPrice;
    }
    
}
