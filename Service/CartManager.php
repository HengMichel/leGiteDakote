<?php

namespace Service;

use DateTime;
use Model\Entity\Rooms;
use Model\Repository\RoomsRepository;

class CartManager
{
    private RoomsRepository $roomsRepository;

    public function __construct()
    {
        $this->roomsRepository = new RoomsRepository;
    }

    public function addCart($id)
    {
// d_die($_SESSION);
// d_die($_POST);
        if(isset($_POST['passerLaCommande'])) 
        {
            extract($_POST);
// d_die($_POST);
            $quantity = $_POST["qte"] ?? 1;
// d_die($quantity);
            $pr = $this->roomsRepository;
            /** @var Rooms */
            $room = $pr->findRoomsById($id);
            // Vérifie si les dates sont valides
            $today = new DateTime();
            $bookingStartDate = new DateTime($booking_start_date);
            $bookingEndDate = new DateTime($booking_end_date);
            if ($bookingStartDate < $today || $bookingEndDate < $today) 
            {
                throw new \Exception("La date de début ou de fin de réservation ne peut pas être antérieure à la date d'aujourd'hui.");
            }
            if ($bookingEndDate <= $bookingStartDate) 
            {
                throw new \Exception("La date de fin de réservation ne peut pas être antérieure à la date de début de réservation.");
            }
            if ($bookingStartDate > $bookingEndDate) 
            {
                throw new \Exception("La date de début de réservation ne peut pas être postérieure à la date de fin de réservation.");
            }
            // Calcule la différence de dates
            $diff = $bookingStartDate->diff($bookingEndDate);
// d_die($diff);
            // Calcule le nombre de jours de réservation
            $nbDays = $diff->days;
// d_die($nbDays);
            // Vérifie si les dates de réservation sont valides
            if ($nbDays <= 0) 
            {
                throw new \Exception("La date de fin de réservation ne peut pas être antérieure ou égale à la date de début de réservation.");
            }
            // Calcule le prix total en fonction du nombre de jours de réservation et de la quantité
            $totalPrice = $nbDays * $room->getPrice();
// d_die($totalPrice);
// d_die($quantity);
// d_die($room->getPrice());
// d_die($nbDays);
            // Mets à jour le prix total avec la methode calculateTotalPrice()
            $_SESSION['totalPrice'] = $totalPrice;
// d_die($_SESSION['totalPrice']);
            if(!isset($_SESSION["cart"])) 
            {
                $_SESSION["cart"] = [];
            }
            // Récupère le panier depuis la session
            $cart = $_SESSION["cart"] ?? [];
// d_die($cart);
            $roomDejaDanscart = false;
            foreach ($cart as $indice => $value) 
            {
                if ($room->getId_room() == $value["room"]->getId_room()) 
                {
                    $roomDejaDanscart = true;
                    // pour sortir de la boucle foreach
                    break;  
                }
            }
// d_die($roomDejaDanscart);
// d_die($cart[$indice]["quantity"]);
            if (!$roomDejaDanscart) 
            {
                $cart[] = ["room" => $room, "date_debut" => $booking_start_date, "date_fin" => $booking_end_date, "totalPrice" => $totalPrice];  
                // on ajoute une value au cart => $cart est un array 
            }
// d_die(!$roomDejaDanscart);
            // je remets $cart dans la session, à l'indice 'cart'
            $_SESSION["cart"] = $cart; 
// d_die($_SESSION["cart"]);
            // Recalcule le prix total après avoir mis à jour le panier
            $this->calculateTotalPrice();
// d_die($this->calculateTotalPrice());
// d_die($quantity);
            // Redirige vers le tableau de bord
            return redirection(addLink("cart","detailCart"));
        }
    }

    public function calculateTotalPrice()
    {
        $totalPrice = 0;
        if(isset($_SESSION['cart'])) 
        {
            foreach($_SESSION['cart'] as $reservation) 
            {
                $bookingStartDate = new DateTime($reservation['date_debut']);
                $bookingEndDate = new DateTime($reservation['date_fin']);
                // Calcule la différence de dates
                $diff = $bookingStartDate->diff($bookingEndDate);
// d_die($diff);
                // Calcule le nombre de jours de réservation en ajoutant 1 si nécessaire
                $nbDays = $diff->days;
// d_die($nbDays);
                // Calcule le prix total en fonction du nombre de jours de réservation, de la quantité et du prix de la chambre
                $totalPrice += $reservation['room']->getPrice() * $nbDays;
// d_die($reservation['room']->getPrice());
// d_die($reservation['quantity']);
// d_die($totalPrice);
            }
        }
        // Mettre à jour le prix total dans la session
        $_SESSION['totalPrice'] = $totalPrice;
        return $totalPrice;
    }
    
    public function cancelCart($roomId) 
    {
        if(isset($_SESSION['cart'])) 
        {
            foreach($_SESSION['cart'] as $key => $reservation) 
            {
                if($reservation['room']->getId_room() == $roomId) 
                {
                    unset($_SESSION['cart'][$key]);
                    break;
                }
            }
            // Recalcule le prix total après l'annulation avec la methode calculateTotalPrice()
            $_SESSION['totalPrice'] = $this->calculateTotalPrice();
// d_die($_SESSION['totalPrice']);
        }
        // Redirige l'utilisateur vers la page du panier après l'annulation
        return redirection(addLink("cart", "detailCart"));
    }
}
