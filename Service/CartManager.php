<?php

namespace Service;

use Model\Repository\BookingsRepository;

/**
 * Summary of BookingsController
 */
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
        $room = $pr->findById('room', $id);

        if(!isset($_SESSION["cart"]))
            $_SESSION["cart"] = [];
        
        // on récupère ce qu'il y a dans le cart en session
        $cart = $_SESSION["cart"]; 

        $roomDejaDanscart = false;
        foreach ($cart as $indice => $value) {
            if ($room->getId() == $value["room"]->getId()) {
                $cart[$indice]["quantity"] += $quantity;
                $roomDejaDanscart = true;
                break;  // pour sortir de la boucle foreach
            }
        }
        
        if (!$roomDejaDanscart) {
            $cart[] = ["quantity" => $quantity, "room" => $room];  // on ajoute une value au cart => $cart est un array d'array
        }
        
        $_SESSION["cart"] = $cart;  // je remets $cart dans la session, à l'indice 'cart'
        
        $nb = 0;
        foreach ($cart as $value){
            $nb += $value["quantity"];
        }
        $_SESSION["nombre"] = $nb;
        return $nb;
    }
}