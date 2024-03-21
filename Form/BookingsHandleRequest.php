<?php
namespace Form;

use Model\Entity\Bookings;
use Model\Repository\BookingsRepository;

class BookingsHandleRequest extends BaseHandleRequest
{
    private $bookingsRepository;

    const START_DATE = 'booking_start_date';
    const END_DATE = 'booking_end_date';
    const USER_ID = 'user_id';
    const ROOM_ID = 'room_id';

// type string
    const PRICE = 'price';
// ####################
    public function __construct()
    {
        $this->bookingsRepository = new BookingsRepository;
    }

    public function handleForm(Bookings $bookings)
    {
    // d_die($_POST);

        if (isset($_POST['book'])) {

            extract($_POST);
            $errors = [];

//###################### gestion de la date ##############################
            // converti en date en seconde avec strtotime depuis le 1janvier 1960         
            $booking_start_date = date("Y-m-d", strtotime($_POST[self::START_DATE]));
            $booking_end_date = date("Y-m-d", strtotime($_POST[self::END_DATE]));
            // d_die($booking_start_date);

// Ajoute les valeurs des dates de début et de fin dans l'objet $bookings
            $bookings->setBooking_start_date($booking_start_date);
            $bookings->setBooking_end_date($booking_end_date);

            // Calculer la durée de la réservation en jours
            $duration = strtotime($booking_end_date) - strtotime($booking_start_date);
            // Nombre de secondes dans une journée
            $nbDays = $duration / 86400; 

            // Initialisez la variable $totalPrice à 0
            $totalPrice = 0;

            // Effectuez le calcul du prix total de la réservation
            if (!empty($_POST['price'])) {

                //converted price ("string") to float
                $pricePerDay = floatval($_POST['price']);
                $totalPrice = $pricePerDay * $nbDays;
            }
            // d_die($_POST['price']);                   
            $bookings->setBooking_price($totalPrice);
            
            // date du jour
            $todayDate = time();

            // Vérification de la validité du formulaire
             if (empty($booking_start_date)) {
                $errors[] = "La date de début ne peut pas être vide";
                }

            if (empty($booking_end_date)) {
                $errors[] = "La date de fin ne peut pas être vide";
                }

            // Est-ce que user_id ,booking_start_date et booking_end_date existe déjà dans la bdd ?
            $request = $this->bookingsRepository->findByAttributes($bookings,
            [self::START_DATE => $booking_start_date,self::END_DATE => $booking_end_date,self::USER_ID => $_POST[self::USER_ID]]);

            if ($request) {
                $errors[] = "La chambre n'est pas disponible pour cette période";
            }
            
            // si $today est > a la date de début de réservation ou $today est > à la date de fin de réservation  
            if (strtotime($today) > strtotime($_POST[self::START_DATE]) || strtotime($today) > strtotime($_POST[self::END_DATE])) {
                if ($todayDate > $_POST[self::START_DATE] || $todayDate > $_POST[self::END_DATE]) {

                    $errors[] = "votre date de début ou de fin de réservation ne peut pas être inférieur à la date d'aujourd'hui";
                } else{ 
// ###############################################################################



// Vérifie si l'utilisateur est connecté
            if (isset($_SESSION['user_id'])) {

// L'utilisateur est connecté, associez les réservations à son compte
                $userId = $_SESSION['user_id'];
                $bookings->setUser_id($userId);

// Ajoute les réservations à la base de données
                $this->bookingsRepository->addBookings($bookings);
            } else {

// L'utilisateur n'est pas connecté, crée un cookie avec les détails de la réservation
                $cookieName = 'pending_booking_' . uniqid();

// Converti l'objet réservation en chaîne sérialisée
                $cookieValue = serialize($bookings); 
// Valable pendant 30 jours
                setcookie($cookieName, $cookieValue, time() + (86400 * 30), '/'); 
            }
// Ainsi, si l'utilisateur est connecté, les réservations seront associées à son compte et stockées dans la base de données. Sinon, les détails de la réservation seront stockés dans un cookie. Une fois que l'utilisateur se connecte, vous pouvez récupérer les réservations en attente à partir du cookie et les associer à son compte utilisateur.

// Assurez-vous de prendre en compte la sécurité des cookies en vérifiant et en validant les données avant de les utiliser.

// ###############################################################################






    // d_die($_SESSION);
// ###################  Si pas connecté ######################################### 
                if($bookings->getUser_id() == null){
                    $errors[] = "Merci de vous connectez avant toute réservation";
                    }
                }
// ####################################################################################

            // Si aucune erreur, définir les propriétés de l'entité
            if (empty($errors)) {             
                $bookings->setUser_id($_POST[self::USER_ID]);
                $bookings->setBooking_start_date($booking_start_date);
                $bookings->setBooking_end_date($booking_end_date);
                $bookings->setBooking_price($_POST['price']);
                $bookings->setBooking_state($_POST['state']);
    
                // d_die($_POST); 
                return true;
                }
                // Gère les erreurs
                $this->setEerrorsForm($errors);
 
            // } else {
            // d_die($_POST); 
                $errors[] = "Des données obligatoires sont manquantes dans le formulaire.";
            }      
        }      
    }
    
    
    public function cancelPanier($idBooking)
    {
         // Vérifier si la réservation existe dans le panier de la session
        if (isset($_SESSION['panier']) && is_array($_SESSION['panier'])) {
        // Parcourir le panier pour trouver la réservation à annuler
            foreach ($_SESSION['panier'] as $key => $item) {
            // Vérifier si l'élément est une réservation et correspond à l'ID   fourni
                if (is_array($item) && isset($item['booking_id']) && $item['booking_id'] == $idBooking) {
                // Supprimer la réservation du panier
                unset($_SESSION['panier'][$key]);
                // Sortir de la boucle une fois la réservation annulée
                break;
                }
            }
        }
    }

    public function annulerPanier() {
        d_die($_GET['id_booking']);
        // Vérifier si un ID de réservation est fourni dans l'URL
        if (isset($_GET['id_booking'])) {
            // Récupérer l'ID de la réservation depuis l'URL
            $idPanier = $_GET['id_booking'];
            
            // Annuler la réservation en appelant la fonction cancelBooking
            $this->cancelPanier($idPanier);
        }
    }
    
}