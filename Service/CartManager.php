<?php

namespace Service;

use Model\Repository\RoomsRepository;

/**
 * Summary of RoomsController
 */
class CartManager
{
    private RoomsRepository $roomsRepository;

    // public function __construct()

    // Injection de Dépendances 
    public function __construct(RoomsRepository $roomsRepository)

    {
        // $this->roomsRepository = new RoomsRepository;
        $this->roomsRepository = $roomsRepository;

    }

    public function addCart($id){

        // Démarrer la session si elle n'est pas déjà démarrée
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Log pour débogage
        error_log("ID de la chambre reçu : " . $id);

        $quantity = $_GET["qte"] ?? 1;
        $pr = $this->roomsRepository;
        $rooms = $pr->findRoomsById('rooms', $id);

        // Log pour débogage
        // error_log("Fin de la méthode addCart pour l'ID : " . $id);

        if ($rooms) {

            $cart = $_SESSION["cart"] ?? [];

            $this->updateCart($cart, $rooms, $quantity);

            $_SESSION["cart"] = $cart;

            $nb = $this->calculateTotalQuantity($cart);
            $_SESSION["nombre"] = $nb;


            error_log("Rooms : " . print_r($rooms, true));

 // Ajoutez ces lignes pour déboguer
 error_log("Réponse JSON envoyée : " . json_encode(['error' => false, 'message' => '', 'count' => $nb]));

            // Retournez la réponse JSON avec un seul objet contenant à la fois un message d'erreur et la clé "count"
            header('Content-Type: application/json');
            http_response_code(200);
            echo json_encode(['error' => false, 'message' => '', 'count' => $nb]);
        } else {

              // Ajoutez ces lignes pour déboguer
    error_log("Réponse JSON envoyée : " . json_encode(['error' => true, 'message' => 'Room not found', 'count' => null]));


            // Retournez la réponse JSON avec le message d'erreur
            header('Content-Type: application/json');
            http_response_code(404);
            echo json_encode(['error' => true, 'message' => 'Room not found', 'count' => null]);

        }       
// Ajoutez ces lignes pour déboguer
error_log("Fin du script PHP");

        // S'assurer qu'il n'y a pas de sortie HTML ou d'autres sorties indésirables après cette instruction
        exit();
        }

        private function updateCart(array &$cart, $rooms, $quantity)
        {
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
        }

        private function calculateTotalQuantity(array $cart): int
        {
        $nb = 0;
        foreach ($cart as $value) {
            $nb += $value["quantity"];
        }

        return $nb;
        
        }


}