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

    public function addCart($id)
    {
        // mofif ici 
         // Ajoutez ce log pour vérifier que l'ID est correct
    error_log("Received ID in addCart: " . $id);
        // #####################

        $quantity = $_GET["qte"] ?? 1;
        $pr = $this->roomsRepository;
        $rooms = $pr->findRoomsById($id);

        if ($rooms) {
            if (!isset($_SESSION["cart"])) {
                $_SESSION["cart"] = [];
            }

            $cart = $_SESSION["cart"];
            $roomsDejaDanscart = false;


            foreach ($cart as $indice => $value) {
                if ($rooms->getId_room() == $value["rooms"]->getId_room()) {
                    $cart[$indice]["quantity"] += $quantity;
                    $roomsDejaDanscart = true;
                    break;
                }
            }

            if (!$roomsDejaDanscart) {
                $cart[] = ["quantity" => $quantity, "rooms" => $rooms];
            }

            $_SESSION["cart"] = $cart;

            $nb = 0;
            foreach ($cart as $value) {
                $nb += $value["quantity"];
            }
            $_SESSION["nombre"] = $nb;

            // Retournez la réponse JSON avec un seul objet contenant à la fois un message d'erreur et la clé "count"
            echo json_encode(['error' => false, 'message' => '', 'count' => $nb]);

        } else {
// modif ici
// Ajoutez des logs pour déboguer
error_log("Room not found for ID: " . $id);
// ###################
          
            // Retournez la réponse JSON avec le message d'erreur
            echo json_encode(['error' => true, 'message' => 'Room not found', 'count' => null]);
            
        }
        exit();
    }
}

