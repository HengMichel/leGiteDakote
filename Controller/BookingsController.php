<?php

namespace Controller;

use Service\Session;
use Model\Entity\Users;
use Model\Entity\Bookings;
use Controller\BaseController;
use Form\BookingsHandleRequest;
use Model\Repository\BookingsRepository;

class BookingsController extends BaseController
{
    private $bookingsRepository;
    private $form;
    private $bookings;

    public function __construct()
    {
        $this->bookingsRepository = new BookingsRepository;
        $this->form = new BookingsHandleRequest;
        $this->bookings = new Bookings;
    }

    public function list(){

        $bookingss = $this->bookingsRepository->findBookings($this->bookings);

        $this->render("bookings/list_bookings.php", [
            "bookingss" => $bookingss
        ]);
    }

    public function newBookings()
    {
        // Récupère les paramètres POST
        $user_id = $_POST['user_id'] ?? null;
    // d_die($room_id,);
        $room_id = $_POST['room_id'] ?? null;
    // d_die($room_id,);
        $price = $_POST['price'] ?? null;
    // d_die($price,);

        // Instancie l'objet Bookings avec les données appropriées
        $bookings = new Bookings();
        $bookings->setUser_id($user_id);
    // d_die($user_id);
        $bookings->setRoom_id($room_id);
    // d_die($room_id);
        $bookings->setBooking_price($price);
    // d_die($price);       
    // d_die($bookings);

// Récupère l'utilisateur connecté
        $user = Session::getConnectedUser();

// S'assurer que user_id est défini sur l'objet $bookings
        if ($user instanceof Users) {
             $bookings->setUser_id($user->getId_user());
        }

        // Passe les données à la vue
        $data = [
            'bookings' => $bookings,
            'user_id' => $user_id,
            'room_id' => $room_id,
            'price' => $price,
            // 'room_imgs' => $room_imgs,
            // 'room_state' => $room_state,
        ];
        // d_die($rooms)

        $this->form->handleForm($bookings);
        // d_die($bookings);


        // Vérifie si le formulaire est soumis
        if ($this->form->isSubmitted()) {
        // d_die($bookings);

            // Vérifie s'il n'y a pas d'erreurs dans les données soumises
            if ($this->form->isValid()) {
            // d_die($_SESSION);
            // d_die($bookings);

// Ajoute la réservation à la base de données
                $success = $this->bookingsRepository->addBookings($bookings);
                // d_die($success); return bool(true)
                
                $success = $this->render("bookings/booking_show.php");

                if ($success) {
                // d_die($_SESSION);
                // d_die($bookings);

// Redirige vers le tableau de bord
                    return redirection(addLink("users","dashUsers"));

                } else {
                    // Gestion d'une éventuelle erreur lors de l'ajout de la réservation
                    $errors = ["Une erreur s'est produite lors de l'ajout de la réservation."];
                }
            }

        }
        // Récupère les erreurs du formulaire
        $errors = $this->form->getEerrorsForm();

        return $this->render("bookings/form_bookings.php",$data + [
            "errors" => $errors
        ]);
    }      

  
    public function cancelBooking($id)
    {
        // Annule la réservation
        $success = $this->bookingsRepository->cancelBooking($id);

        if ($success) {
        // d_die($bookings);

        // Redirige vers le tableau de bord
        return redirection(addLink("users","dashUsers"));

        } else {
            // Récupére les erreurs du formulaire
            $errors = $this->form->getEerrorsForm();
            return $this->render("bookings/form_bookings.php", [
                "errors" => $errors
            ]);
        
        }
    }

    public function newPanier()
{
    // Récupère les paramètres POST
    $user_id = $_POST['user_id'] ?? null;
    $room_id = $_POST['room_id'] ?? null;
    $price = $_POST['price'] ?? null;
    
    // Instancie l'objet Bookings avec les données appropriées
    // $bookings = new Bookings();
    // $bookings->setUser_id($user_id);
    // $bookings->setRoom_id($room_id);
    // $bookings->setBooking_price($price);
      
    // Stockez les informations du panier dans la session
    $_SESSION['panier'][] = [
        'user_id' => $user_id,
        'room_id' => $room_id,
        'price' => $price
    ];
    // $_SESSION['panier'][] = serialize($bookings);

    // Redirigez l'utilisateur vers la vue du panier
    return redirection(addLink("bookings", "showPanier"));
}

public function showPanier()
{
// Récupérez les informations du panier depuis la session
    $panier = $_SESSION['panier'] ?? [];

    //   // Vérifiez si les éléments du panier sont déjà désérialisés
    // foreach ($panier as $key => $value) {
    //     if (is_string($value)) {
    //         // Si l'élément est une chaîne de caractères, désérialisez-le
    //         $panier[$key] = unserialize($value);
    //     }
    // }

     // Désérialiser les objets Bookings
    //  $panier = array_map('unserialize', $panier);

     // Instanciez un nouvel objet Bookings
     $bookings = new Bookings();

// d_die($panier);
// array(1) {
//   [0]=>
//   array(3) {
//     ["user_id"]=>
//     NULL
//     ["room_id"]=>
//     string(2) "25"
//     ["price"]=>
//     string(2) "50"
//   }
// }

    // Instanciez un nouvel objet Bookings
    // $bookings = new Bookings();
    
    // Passez les informations du panier à la vue
    return $this->render("bookings/show_bookings.php", [
        "panier" => $panier,
        "bookings" => $bookings
    // return $this->render("bookings/booking_show.php", [
    //     "panier" => $panier
    ]);
}

}