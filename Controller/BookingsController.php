<?php

namespace Controller;

use Service\Session;
use Model\Entity\Users;
use Model\Entity\Bookings;
use Controller\BaseController;
use Form\BookingsHandleRequest;
use Model\Repository\BookingsRepository;
use Service\CartManager;

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
        // Récupère l'utilisateur connecté
        $user = Session::getConnectedUser();
        // d_die($user);
        
        $user_id = $user instanceof Users ? $user->getId_user() : null;
        $booking_state = "in progress";
        // d_die($user_id);

        $this->form->handleForm($this->bookings, $user_id);

        // d_die($this->bookings);

        if ($this->form->isSubmitted() && $this->form->isValid()) {
            
            // Ajoute la réservation à la base de données
            $success = $this->bookingsRepository->addBookings($this->bookings);
            // d_die($success); return bool(true)
            
            // $success = $this->render("bookings/booking_show.php")
            if ($success) {
            // d_die($_SESSION);
            // d_die($success);
                // Redirige vers le tableau de bord
                // return redirection(addLink("users","dashUsers"));

                // redirection detailController
                return redirection(addLink("detail","newDetail"));

            } else {
                // Gestion d'une éventuelle erreur lors de l'ajout de la réservation
                $errors = ["Une erreur s'est produite lors de l'ajout de la réservation."];
            }
        }
        // Récupère les erreurs du formulaire
        $errors = $this->form->getEerrorsForm();

        // Affiche le formulaire de réservation
        return $this->render("cart/form_cart.php",[
            "user_id" => $user_id,
            "booking_state" => $booking_state,
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
         // Nettoyer la session du panier si nécessaire
    if (!isset($_SESSION['panier']) || !is_array($_SESSION['panier'])) {
        $_SESSION['panier'] = [];
    }

     // Vérifier les données POST
     if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Récupère les paramètres POST
        $id_booking = $_POST['id_booking'] ?? null;
        $room_id = $_POST['room_id'] ?? null;
        $price = $_POST['price'] ?? null;
        $booking_start_date = $_POST['booking_start_date'] ?? null;
        $booking_end_date = $_POST['booking_end_date'] ?? null;
        $booking_state = $_POST['booking_state'] ?? null;

        // d_die($booking_state);
        
 // Vérifier si toutes les données nécessaires sont présentes
 if ($id_booking && $room_id && $price && $booking_start_date && $booking_end_date && $booking_state) {
    // Créer une nouvelle réservation


        // Instancie l'objet Bookings avec les données appropriées
    $bookings = new Bookings();
    $bookings->setId_booking($id_booking);
    // $bookings->setRoom_id($room_id);
    $bookings->setBooking_price($price);
    // $bookings->setBooking_start_date($booking_start_date);
    // $bookings->setBooking_end_date($booking_end_date);
    $bookings->setBooking_state($booking_state);
        
        // Stockez les informations du panier dans la session
        $_SESSION['panier'][] = $bookings;
        // d_die($_SESSION);

    }
}

        // Redirigez l'utilisateur vers la vue du panier
        return redirection(addLink("bookings", "showPanier"));
    }


    /**
     * Summary of add
     * @param mixed $id
     * @return void
     */
    public function showPanier($id)
    {
        // Récupérez les informations du panier depuis la session
        $panier = $_SESSION['panier'] ?? [];

        // d_die($_SESSION['panier']);

        
        // Passez les informations du panier à la vue
        return $this->render("bookings/show_bookings.php", [
            "panier" => $panier,
        ]);
        // Après avoir ajouté la réservation, redirigez l'utilisateur vers la vue du panier
    // return redirection(addLink("bookings", "showPanier"));
    }



    public function annulerReservation()
    {
        // d_die($_GET['id_booking']);
        // Récupérer l'ID de la réservation à partir de la requête GET
        $idBooking = $_GET['id_booking'] ?? null;

        

        // Vérifier si un ID de réservation est fourni
        if ($idBooking !== null) {

            // Instancier la classe BookingsHandleRequest
            $bookingsHandleRequest = new BookingsHandleRequest();

            // Appeler la méthode annulerPanier pour annuler la réservation
            $bookingsHandleRequest->annulerPanier($idBooking);

             // Rediriger l'utilisateur vers la page de réservation ou une autre page appropriée
             return redirection(addLink("bookings", "showPanier"));

        } else {

    }
    }



// // Méthode pour insérer les réservations de la session dans la base de données
// public function insertReservationsFromSessionIntoDatabase()
// {
//     // Récupérer les réservations de la session
//     $reservations = $_SESSION['panier'] ?? [];
    
//     // Insérer chaque réservation dans la base de données
//     foreach ($reservations as $reservation) {
//         // Insérer la réservation dans la base de données
//         // Assurez-vous de récupérer l'identifiant généré par la base de données
//         // Stockez l'identifiant généré dans la session ou tout autre moyen de suivi
//     }
    
//     // Effacer les réservations de la session après l'insertion dans la base de données
//     unset($_SESSION['panier']);
// }

}