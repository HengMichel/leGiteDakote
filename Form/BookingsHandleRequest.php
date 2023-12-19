<?php

namespace Form;

use Model\Entity\Bookings;
use Model\Repository\BookingsRepository;


class BookingsHandleRequest extends BaseHandleRequest
{
    private $bookingsRepository;

    private $errors = []; // Initialisez la propriété $errors comme un tableau vide



    public function __construct()
    {
        $this->bookingsRepository = new BookingsRepository;
    }

    public function handleForm(Bookings $bookings)
    {
        if (isset($_POST['book'])) {
            // Validation des champs
            if ($this->validateFields($_POST)) {

                // Aucune erreur, on met à jour les propriétés de l'objet $bookings

                // Vérifiez d'abord si la clé existe dans $_POST avant de l'utiliser
                $bookings->setUser_id(isset($_POST['user_id']) ? $_POST['user_id'] : null);
                $bookings->setBooking_start_date(isset($_POST['booking_start_date']) ? $_POST['booking_start_date'] : null);
                $bookings->setBooking_end_date(isset($_POST['booking_end_date']) ? $_POST['booking_end_date'] : null);
                $bookings->setRoom_id(isset($_POST['room_id']) ? $_POST['room_id'] : null);
                $bookings->setBooking_price(isset($_POST['booking_price']) ? $_POST['booking_price'] : null);
                $bookings->setBooking_state("in progress");

    
                // Continuez avec l'étape suivante (par exemple, enregistrez dans la base de données)
    
                // Retournez true pour indiquer que tout s'est bien passé
                return true;
            }
        }
    
            // Si le formulaire n'a pas été soumis ou s'il y a des erreurs, stockez les erreurs
            return $this->errors;
    }
    
    private function validateFields(array $data)
    {
        $errors = [];
    
        // Vérification de la validité du formulaire
        if (empty($data['booking_start_date'])) {
            $errors[] = "La date de début ne peut pas être vide";
        }
    
        if (empty($data['booking_end_date'])) {
            $errors[] = "La date de fin ne peut pas être vide";
        }
    
        // Stockez les erreurs dans une propriété
        $this->errors = $errors;
    
        // Renvoie true si aucune erreur
        return empty($errors);
    }




    public function handleSecurity()
    {
       
        
    }
}