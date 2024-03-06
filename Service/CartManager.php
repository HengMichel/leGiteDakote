<?php

namespace Service;

// use Model\Repository\RoomsRepository;

// class CartManager
// {
//     private RoomsRepository $roomsRepository;

//     public function __construct()
//     {
//         $this->roomsRepository = new RoomsRepository;
//     }

//     public function addCart($id){
//         $quantity = $_GET["qte"] ?? 1;
//         $pr = $this->roomsRepository;
//         $room = $pr->findById('room', $id);

//         if(!isset($_SESSION["cart"]))
//             $_SESSION["cart"] = [];
        
//         // on récupère ce qu'il y a dans le cart en session
//         $cart = $_SESSION["cart"]; 

//         $roomDejaDanscart = false;
//         foreach ($cart as $indice => $value) {
//             if ($room->getId() == $value["room"]->getId()) {
//                 $cart[$indice]["quantity"] += $quantity;
//                 $roomDejaDanscart = true;
//                 break;  // pour sortir de la boucle foreach
//             }
//         }
        
//         if (!$roomDejaDanscart) {
//             $cart[] = ["quantity" => $quantity, "room" => $room];  // on ajoute une value au cart => $cart est un array d'array
//         }
        
//         $_SESSION["cart"] = $cart;  // je remets $cart dans la session, à l'indice 'cart'
        
//         $nb = 0;
//         foreach ($cart as $value){
//             $nb += $value["quantity"];
//         }
//         $_SESSION["nombre"] = $nb;
//         return $nb;

//         // Redirige vers le tableau de bord
//         return redirection(addLink("cart/show.php"));
//     }
// }

use Model\Repository\BookingsRepository;

class CartManager
{
    private BookingsRepository $bookingsRepository;

    public function __construct()
    {
        $this->bookingsRepository = new BookingsRepository;
    }

    public function addCart($id){
        $quantity = $_GET["qte"] ?? 1;
        $pr = $this->bookingsRepository;
        $booking = $pr->findBookingsRoomsById('room_id', $id);

        if(!isset($_SESSION["panier"]))
            $_SESSION["panier"] = [];
        
        // on récupère ce qu'il y a dans le panier en session
        $panier = $_SESSION["panier"]; 

        $bookingDejaDanspanier = false;

        foreach ($panier as $indice => $value) {
        //     if ($booking->getRoom_id() == $value["bookings"]->getRoom_id()) {
                if ($booking && $booking->getRoom_id() == $value["bookings"]->getRoom_id()) {

                        if (!isset($panier[$indice]["quantity"])) {
// Initialise la quantité à 0 uniquement si elle n'est pas déjà définie (correct)
                                $panier[$indice]["quantity"] = 0;
                        }
                // Augmentez la quantité existante
                $panier[$indice]["quantity"] += $quantity;
                $bookingDejaDanspanier = true;
                break;  // pour sortir de la boucle foreach
            }
        }
        
        if (!$bookingDejaDanspanier) {
            $panier[] = ["quantity" => $quantity, "bookings" => $booking];  // on ajoute une value au cart => $cart est un array d'array
        }
        
        $_SESSION["panier"] = $panier;  // je remets $cart dans la session, à l'indice 'cart'
        
        $nb = 0;
        foreach ($panier as $value){
            $nb += $value["quantity"];
        }
        $_SESSION["nombre"] = $nb;
        return $nb;

        // Redirige vers le tableau de bord
        return redirection(addLink("bookings/show_booking.php"));
    }
}