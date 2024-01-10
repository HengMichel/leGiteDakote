<?php

namespace Service;

use Model\Repository\RoomsRepository;

/**
 * Summary of RoomsController
 */
class CartManager
{
    private RoomsRepository $roomsRepository;

    public function __construct()
    {
        $this->roomsRepository = new RoomsRepository;
    }

    public function addCart($id){
        $quantity = $_GET["qte"] ?? 1;
        $pr = $this->roomsRepository;
        $rooms = $pr->findById('rooms', $id);

        if(!isset($_SESSION["cart"]))
            $_SESSION["cart"] = [];
        
        $cart = $_SESSION["cart"]; // on récupère ce qu'il y a dans le cart en session

        $roomsDejaDanscart = false;
        foreach ($cart as $indice => $value) {
            if ($rooms->getId() == $value["rooms"]->getId()) {
                $cart[$indice]["quantity"] += $quantity;
                $roomsDejaDanscart = true;
                break;  // pour sortir de la boucle foreach
            }
        }
        
        if (!$roomsDejaDanscart) {
            $cart[] = ["quantity" => $quantity, "rooms" => $rooms];  // on ajoute une value au cart => $cart est un array d'array
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