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

    public function addCart($id){
        // d_die($_SESSION);
        // d_die($_POST);
        // meme resultat que la methode addToCart
        if(isset($_POST['passerLaCommande'])) {
            // d_die($_POST);
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

        // Calcule la différence de dates
        $diff = $bookingStartDate->diff($bookingEndDate);
        d_die($diff);
        // ["days"]=>int(1)

        // Calcule le nombre de jours de réservation
        // $nbDays = $bookingStartDate->diff($bookingEndDate)->days;
        $nbDays = $diff->days;
        // d_die($nbDays);
        // int(1)

        // Ajouter 1 jour si nécessaire pour inclure la journée de départ
        $nbDays += 1;
        // d_die($nbDays);
        // int(2)

        // Vérifier si les dates de réservation sont valides
        if ($nbDays <= 0) {
            throw new \Exception("La date de fin de réservation ne peut pas être antérieure ou égale à la date de début de réservation.");
        }

        // Calcule le prix total en fonction du nombre de jours de réservation et de la quantité
        $totalPrice = $nbDays * $room->getPrice();
        // d_die($totalPrice);
        // float(100)  c'est le bon resultat 
        // d_die($quantity);
        // int(1) qui represente une reservation c'st ok
        // d_die($room->getPrice());
        // float(50) qui represente une nuit
        // d_die($nbDays);
        // int(2) le nombre de jour tout est ok ici

        // Mets à jour le prix total avec la methode calculateTotalPrice()
        $_SESSION['totalPrice'] = $totalPrice;
        // d_die($_SESSION['totalPrice']);
        // float(100) qui est la resarvation en cours

        if(!isset($_SESSION["cart"])) {
            $_SESSION["cart"] = [];
        }
        
        // on récupère ce qu'il y a dans le cart en session
        // $cart = $_SESSION["cart"]; 
        // d_die($cart);
        // array(2) {
        //     [0]=>
        //     array(5) {
        //       ["quantity"]=>
        //       int(1)
        //       ["room"]=>
        //       object(Model\Entity\Rooms)#2 (11) {
        //         ["id":protected]=>
        //         NULL
        //         ["id_room":"Model\Entity\Rooms":private]=>
        //         int(25)
        //         ["room_number":"Model\Entity\Rooms":private]=>
        //         int(1)
        //         ["price":"Model\Entity\Rooms":private]=>
        //         float(50)
        //         ["room_imgs":"Model\Entity\Rooms":private]=>
        //         string(18) "chambreClass1.webp"
        //         ["persons":"Model\Entity\Rooms":private]=>
        //         int(4)
        //         ["category":"Model\Entity\Rooms":private]=>
        //         string(7) "classic"
        //         ["room_state":"Model\Entity\Rooms":private]=>
        //         string(9) "available"
        //         ["created_at":protected]=>
        //         NULL
        //         ["updated_at":protected]=>
        //         NULL
        //         ["is_deleted":protected]=>
        //         NULL
        //       }
        //       ["date_debut"]=>
        //       string(10) "2024-03-29"
        //       ["date_fin"]=>
        //       string(10) "2024-04-01"
        //       ["totalPrice"]=>
        //       float(150)
        //     }
        //     [1]=>
        //     array(5) {
        //       ["quantity"]=>
        //       int(29)
        //       ["room"]=>
        //       object(Model\Entity\Rooms)#3 (11) {
        //         ["id":protected]=>
        //         NULL
        //         ["id_room":"Model\Entity\Rooms":private]=>
        //         int(26)
        //         ["room_number":"Model\Entity\Rooms":private]=>
        //         int(2)
        //         ["price":"Model\Entity\Rooms":private]=>
        //         float(55)
        //         ["room_imgs":"Model\Entity\Rooms":private]=>
        //         string(13) "chambreP6.jpg"
        //         ["persons":"Model\Entity\Rooms":private]=>
        //         int(4)
        //         ["category":"Model\Entity\Rooms":private]=>
        //         string(7) "piscine"
        //         ["room_state":"Model\Entity\Rooms":private]=>
        //         string(9) "available"
        //         ["created_at":protected]=>
        //         NULL
        //         ["updated_at":protected]=>
        //         NULL
        //         ["is_deleted":protected]=>
        //         NULL
        //       }
        //       ["date_debut"]=>
        //       string(10) "2024-03-29"
        //       ["date_fin"]=>
        //       string(10) "2024-03-30"
        //       ["totalPrice"]=>
        //       float(205)
        //     }
        //   }
        // il y  a un probleme ici les dates correspond a 2 jours et voit ["price":"Model\Entity\Rooms":private]=>
        //         float(55) pour une nuit soit   ["totalPrice"]=>
        //       float(205) n'est pas correct cela devrait etre float(110)

        // Récupérer le panier depuis la session
    $cart = $_SESSION["cart"] ?? [];
// d_die($cart);
// array(0) {
// }
    // Vérifier si la chambre est déjà dans le panier
    $roomIndex = null;
    foreach ($cart as $index => $item) {
        if ($item['room']->getId_room() == $room->getId_room()) {
            $roomIndex = $index;
            break;
        }
    }
    // d_die($roomIndex);
    // NULL
if ($roomIndex !== null) {
        // Mettre à jour la quantité et le prix total de la chambre déjà présente
        $cart[$roomIndex]["quantity"] += $quantity;
        $cart[$roomIndex]["totalPrice"] += $totalPrice;
    } else {
        // Ajouter la nouvelle réservation au panier
        $cart[] = ["quantity" => $quantity, "room" => $room, "date_debut" => $booking_start_date, "date_fin" => $booking_end_date, "totalPrice" => $totalPrice]; 
        // d_die($cart);
 
    }
    // d_die($cart);




        // $roomDejaDanscart = false;
        // foreach ($cart as $indice => $value) {
        //     if ($room->getId_room() == $value["room"]->getId_room()) {
        //         $cart[$indice]["quantity"] += $quantity;
        //         $roomDejaDanscart = true;
        //         break;  
                // pour sortir de la boucle foreach
        //     }
        // }
        
        // if (!$roomDejaDanscart) {
        //     $cart[] = ["quantity" => $quantity, "room" => $room, "date_debut" => $booking_start_date, "date_fin" => $booking_end_date, "totalPrice" => $totalPrice];  
            // on ajoute une value au cart => $cart est un array d'array
        // }
        
        
        // je remets $cart dans la session, à l'indice 'cart'
        $_SESSION["cart"] = $cart; 
        // d_die($_SESSION["cart"]);
        // array(1) {
        //     [0]=>
        //     array(5) {
        //       ["quantity"]=>
        //       int(3)    ########  ici c'etait int(1)
        //       ["room"]=>
        //       object(Model\Entity\Rooms)#2 (8) {
        //         ["id":protected]=>
        //         NULL
        //         ["id_room":"Model\Entity\Rooms":private]=>
        //         int(25)
        //         ["room_number":"Model\Entity\Rooms":private]=>
        //         int(1)
        //         ["price":"Model\Entity\Rooms":private]=>
        //         float(50)
        //         ["room_imgs":"Model\Entity\Rooms":private]=>
        //         string(18) "chambreClass1.webp"
        //         ["persons":"Model\Entity\Rooms":private]=>
        //         int(4)
        //         ["category":"Model\Entity\Rooms":private]=>
        //         string(7) "classic"
        //         ["room_state":"Model\Entity\Rooms":private]=>
        //         string(9) "available"
        //       }
        //       ["date_debut"]=>
        //       string(10) "2024-03-29"
        //       ["date_fin"]=>
        //       string(10) "2024-03-30"
        //       ["totalPrice"]=>
        //       float(300)  ####### et la float(100)
        //     }
        //   }   Pour 3 refresh cela c'est autoincremente

        // Recalculez le prix total après avoir mis à jour le panier
        $this->calculateTotalPrice();
        // d_die($this->calculateTotalPrice());
        // resultat ici = int(200) 
        
        // d_die($quantity);
        // resultat ici = int(1)
        // Redirige vers le tableau de bord
        return redirection(addLink("cart","detailCart"));
        }
    }

    public function calculateTotalPrice(): int {
        $totalPrice = 0;
    
        if(isset($_SESSION['cart'])) {
            foreach($_SESSION['cart'] as $reservation) {
                $bookingStartDate = new DateTime($reservation['date_debut']);
                $bookingEndDate = new DateTime($reservation['date_fin']);
    
                // Calculer la différence de dates
                $diff = $bookingStartDate->diff($bookingEndDate);
    
                // Calculer le nombre de jours de réservation en ajoutant 1 si nécessaire
                $nbDays = $diff->days;
                if ($nbDays == 0) {
                    $nbDays = 1;
                }
    
                // Vérifier si les dates de réservation sont valides
                if ($nbDays <= 0) {
                    throw new \Exception("La date de fin de réservation ne peut pas être antérieure ou égale à la date de début de réservation.");
                }
    
                // Calculer le prix total en fonction du nombre de jours de réservation, de la quantité et du prix de la chambre
                $totalPrice += $reservation['room']->getPrice() * $reservation['quantity'] * $nbDays;
                // d_die($reservation['room']->getPrice());
                // resultat ici = float(50)
                // d_die($reservation['quantity']);
                // resultat ici = int(7) pas bon s'auto incremente a chaque refresh 

                // d_die($bookingStartDate);
                // resultat ici = object(DateTime)#18 (3) {
                //   ["date"]=>
                //   string(26) "2024-03-29 00:00:00.000000"
                //   ["timezone_type"]=>
                //   int(3)
                //   ["timezone"]=>
                //   string(13) "Europe/Berlin"
                // }
                // d_die($bookingEndDate);
                // resultat ici = object(DateTime)#19 (3) {
                //   ["date"]=>
                //   string(26) "2024-04-01 00:00:00.000000"
                //   ["timezone_type"]=>
                //   int(3)
                //   ["timezone"]=>
                //   string(13) "Europe/Berlin"
                // }
                // d_die($totalPrice);
                // resultat ici = float(500)
            }
        }
    
        // Mettre à jour le prix total dans la session
        $_SESSION['totalPrice'] = $totalPrice;
    
        return $totalPrice;
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
            $_SESSION['totalPrice'] = $this->calculateTotalPrice();
            // d_die($_SESSION['totalPrice']);
            // ici = float(50)
        }
        // Redirige l'utilisateur vers la page du panier après l'annulation
        return redirection(addLink("cart", "detailCart"));
    }
}
