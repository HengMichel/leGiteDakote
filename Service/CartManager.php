<?php

namespace Service;

use Model\Repository\RoomsRepository;

class CartManager
{
    private RoomsRepository $roomsRepository;

    public function __construct()
    {
        $this->roomsRepository = new RoomsRepository;
    }

    // public function addCart($id)
    // {

    //     // Vérifie que l'ID est correct
    //     error_log("Received ID in addCart: " . $id);

    //     $quantity = $_GET["qte"] ?? 1;
    //     $pr = $this->roomsRepository;
    //     $rooms = $pr->findRoomsById($id);

    //     if ($rooms) {
    //         if (!isset($_SESSION["cart"])) {
    //             $_SESSION["cart"] = [];
    //         }
    //         // on récupère ce qu'il y a dans le cart en session
    //         $cart = $_SESSION["cart"];

    //         $roomsDejaDanscart = false;
    //         foreach ($cart as $indice => $value) {
    //             if ($rooms->getId_room() == $value["rooms"]->getId_room()) {
    //                 $cart[$indice]["quantity"] += $quantity;
    //                 $roomsDejaDanscart = true;

    //                 // pour sortir de la boucle foreach
    //                 break;
    //             }
    //         }

    //         if (!$roomsDejaDanscart) {
    //             $cart[] = ["quantity" => $quantity, "rooms" => $rooms];
    //         }

    //         $_SESSION["cart"] = $cart;

    //         $nb = 0;
    //         foreach ($cart as $value) {
    //             $nb += $value["quantity"];
    //         }
    //         $_SESSION["nombre"] = $nb;

    //         // Retourne la réponse JSON avec un seul objet contenant à la fois un message d'erreur et la clé "count"
    //         echo json_encode(['error' => false, 'message' => '', 'count' => $nb]);

    //     } else {
    //         // Ajoutez des logs pour déboguer
    //         error_log("Room not found for ID: " . $id);
          
    //         // Retournez la réponse JSON avec le message d'erreur
    //         echo json_encode(['error' => true, 'message' => 'Room not found', 'count' => null]);
            
    //     }
    //     exit();
    // }

    // public function delectCart($id)
    // {

    //     // Vérifie que l'ID est correct
    //     error_log("Received ID in addCart: " . $id);

    //     $quantity = $_GET["qte"] ?? 1;
    //     $pr = $this->roomsRepository;
    //     $rooms = $pr->findRoomsById($id);

    //     if ($rooms) {
    //         if (!isset($_SESSION["cart"])) {
    //             $_SESSION["cart"] = [];
    //         }

    //         $cart = $_SESSION["cart"];
    //         $roomsDejaDanscart = false;

    //         foreach ($cart as $indice => $value) {
    //             if ($rooms->getId_room() == $value["rooms"]->getId_room()) {
    //                 $cart[$indice]["quantity"] += $quantity;
    //                 $roomsDejaDanscart = true;
    //                 break;
    //             }
    //         }

    //         if (!$roomsDejaDanscart) {
    //             $cart[] = ["quantity" => $quantity, "rooms" => $rooms];
    //         }

    //         $_SESSION["cart"] = $cart;

    //         $nb = 0;

    //         foreach ($cart as $value) {
    //             $nb -= $value["quantity"];
    //         }
    //         $_SESSION["nombre"] = $nb;

    //         // Retourne la réponse JSON avec un seul objet contenant à la fois un message d'erreur et la clé "count"
    //         echo json_encode(['error' => false, 'message' => '', 'count' => $nb]);

    //     } else {
    //         // Ajoutez des logs pour déboguer
    //         error_log("Room not found for ID: " . $id);
          
    //         // Retournez la réponse JSON avec le message d'erreur
    //         echo json_encode(['error' => true, 'message' => 'Room not found', 'count' => null]);
            
    //     }
    //     exit();
    // }

//     private function updateCart($id, $quantity)
//     {
//         $rooms = $this->roomsRepository->findRoomsById($id);

//         if (!$rooms) {
//             // Retourne la réponse JSON avec le message d'erreur
//             echo json_encode(['error' => true, 'message' => 'Room not found', 'count' => null]);
//             exit();
//         }

//         $cart = $_SESSION["cart"] ?? [];
//         $roomFoundInCart = false;

//         foreach ($cart as $indice => $value) {
//             if ($rooms->getId_room() == $value["rooms"]->getId_room()) {
//                 $cart[$indice]["quantity"] += $quantity;
//                 $roomFoundInCart = true;
//                 break;
//             }
//         }

//         if (!$roomFoundInCart) {
//             $cart[] = ["quantity" => $quantity, "rooms" => $rooms];
//         }

//         $_SESSION["cart"] = $cart;

//         $nb = 0;

//         foreach ($cart as $value) {
//             $nb += $value["quantity"];
//         }

//         $_SESSION["nombre"] = $nb;

//         // Retourne la réponse JSON avec un seul objet contenant à la fois un message d'erreur et la clé "count"
//         echo json_encode(['error' => false, 'message' => '', 'count' => $nb]);
//         exit();
//     }

//     public function addCart($id)
//     {
//         $quantity = $_GET["qte"] ?? 1;
//         $this->updateCart($id, $quantity);
//     }

//     public function delectCart($id)
//     {
//         $quantity = $_GET["qte"] ?? 1;
//         $this->updateCart($id, -$quantity);
//     }

}

