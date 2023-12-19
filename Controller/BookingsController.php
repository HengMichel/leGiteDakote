<?php

namespace Controller;

use Service\Session;
use Model\Entity\Bookings;
use Controller\BaseController;
use Form\BookingsHandleRequest;
use Model\Repository\BookingsRepository;
use Model\Repository\RoomsRepository;

class BookingsController extends BaseController
{
    private $bookingsRepository;
    private $form;
    private $bookings;
    private $roomsRepository;

    public function __construct()
    {
        $this->bookingsRepository = new BookingsRepository;
        $this->form = new BookingsHandleRequest;
        $this->bookings = new Bookings;
        $this->roomsRepository = new RoomsRepository;
    }

    public function list(){

        $bookingss = $this->bookingsRepository->findBookings($this->bookings);

        $this->render("bookings/list_bookings.php", [
            "bookingss" => $bookingss
        ]);
    }

    public function newBookings()
    {

        $bookings = $this->bookings;
        $this->form->handleForm($bookings);

         // Vérifiez si le formulaire est soumis
        if ($this->form->isSubmitted()) {

            // Vérifiez s'il n'y a pas d'erreurs dans les données soumises
            if ($this->form->isValid()) {
                // Assurez-vous que user_id est défini sur l'objet $bookings
                Session::isConnected();
      
                // Ajoutez la réservation à la base de données
                $success = $this->bookingsRepository->addBookings($bookings);
                // d_die($success);
                if ($success) {

                    // Redirigez vers le tableau de bord ou une autre page            
                    return redirection(addLink("users","dashUsers"));

                } else {
                    // Gestion d'une éventuelle erreur lors de l'ajout de la réservation
                    $errors = ["Une erreur s'est produite lors de l'ajout de la réservation."];
                }
            }

        } else {
        // Si le formulaire n'a pas été soumis, ne faites rien ici.
        // Vous pouvez ajouter une logique supplémentaire si nécessaire.
        }
        // Récupérez les erreurs du formulaire

        $errors = $this->form->getEerrorsForm();

        return $this->render("bookings/form_bookings.php",  [
            "bookings" => $bookings,
            "errors" => $errors
        ]);
    }
        

    
    
    // public function modifBookings($bookings)
    // {
    //     $bookingss = $this->bookingsRepository->cancelBookings($this->bookings);
    //     $this->bookingsRepository->cancelBookings($bookings);
    //     return redirection(addLink("bookings"));

    // }

    public function showBooking($id)
    {
        $bookings = $this->bookingsRepository->findBookingsById($id);
        // ajout d'une condition en cas de la valeur null de $user afin d'ajouter un message d'erreur dans la session
        return $this->render("users/dashboard_users.php", [
            "bookings" => $bookings,
        ]);
    }
    

    // public function findContestById($id){

    //     $contest = Contest::findContestById($id);

    //     $this->render("list_contest.php");
    // }
}