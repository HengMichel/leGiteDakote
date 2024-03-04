<?php

namespace Service;

use Model\Repository\RoomsRepository;

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
        
        // on récupère ce qu'il y a dans le cart en session
        // $cart = $_SESSION["cart"]; 

        // $roomDejaDanscart = false;
        // foreach ($cart as $indice => $value) {
        //     if ($room->getId() == $value["room"]->getId()) {
        //         $cart[$indice]["quantity"] += $quantity;
        //         $roomDejaDanscart = true;
                // break;  // pour sortir de la boucle foreach
        //     }
        // }
        
        // if (!$roomDejaDanscart) {
        //     $cart[] = ["quantity" => $quantity, "room" => $room];  // on ajoute une value au cart => $cart est un array d'array
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