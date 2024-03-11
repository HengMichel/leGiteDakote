<?php

namespace Controller;

use Service\Session;
use Model\Entity\Rooms;
use Model\Entity\Detail;
use Form\DetailHandleRequest;
use Controller\BaseController;
use Model\Repository\RoomsRepository;
use Model\Repository\DetailRepository;

class DetailController extends BaseController
{
    private $detailRepository;
    private $roomsRepository;
    
    private $form;
    private $detail;

    public function __construct()
    {
        $this->detailRepository = new DetailRepository;
        $this->roomsRepository = new RoomsRepository;
        $this->form = new DetailHandleRequest;
        $this->detail = new Detail;
    }


    public function newDetail()
    {
        // Récupère les paramètres POST
        $id_room = $_POST['id_room'] ?? null;
        // d_die($id_room);
        // resultat: string(2) "25"

        $booking_id = $_POST['booking_id'] ?? null;
        // d_die($booking_id,);

        $booking_start_date = $_POST['booking_start_date'] ?? null;
        // d_die($booking_start_date,);
        // resultat: string(10) "2024-03-11"

        $booking_end_date = $_POST['booking_end_date'] ?? null;
        // d_die($booking_end_date,);
        // resultat: string(10) "2024-03-12"

        // d_die($_POST);
        // array(5) {
//   ["id_room"]=>
//   string(2) "25"
//   ["price"]=>
//   string(2) "50"
//   ["booking_start_date"]=>
//   string(10) "2024-03-11"
//   ["booking_end_date"]=>
//   string(10) "2024-03-12"
//   ["submit"]=>
//   string(0) ""
// }

        // Instancie l'objet Bookings avec les données appropriées
        $detail = new Detail();
        $detail->setRoom_id($id_room);
        // d_die($room_id);

        $detail->setBooking_Id($booking_id);
        // d_die($booking_id);

        $detail->setBooking_start_date($booking_start_date);
        // d_die($booking_start_date);   

        $detail->setBooking_end_date($booking_end_date);
        // d_die($booking_start_date);

        

//############################################### pas de user connecté ici  
        // Récupère l'utilisateur connecté
        // $user = Session::getConnectedUser();

        //  S'assurer que user_id est défini sur l'objet $detail
        // if ($detail instanceof Detail) {
        //      $detail->setRoom_id($detail->getRoom_id());
        // }
//##############################################################################

    // Charger les données de la chambre à partir de son identifiant
    $price = $this->detailRepository->getRoomPriceById($id_room);
    // d_die($price);

// Vérifier si la valeur retournée est valide avant d'utiliser getPrice()
if ($price !== null) {

        // Passe les données à la vue
        $data = [
            'detail' => $detail,
            'id_room' => $id_room,
            // 'booking_id' => $booking_id,
            'booking_start_date' => $booking_start_date,
            'booking_end_date' => $booking_end_date,
            'price' => $price,
        ];
        // d_die($data);
    } else {
        // Gérer le cas où le prix n'est pas disponible
        // Par exemple, rediriger vers une page d'erreur ou afficher un message d'erreur
        echo "Le prix de la chambre n'est pas disponible.";
    }

        $this->form->handleFormDetail($detail,$id_room);
        // d_die($detail);
        // d_die($this);

        // Vérifie si le formulaire est soumis
        if ($this->form->isSubmitted()) {
        // d_die($detail);

            // Vérifie s'il n'y a pas d'erreurs dans les données soumises
            if ($this->form->isValid()) {
            // d_die($_SESSION);
            // d_die($detail);

                // Ajoute la réservation à la base de données
                $success = $this->detailRepository->addDetail($detail);
                // d_die($success); return bool(true)

                if ($success) {
                // d_die($_SESSION);
                // d_die($detail);

                    // Redirige vers le tableau de bord
                    // return redirection(addLink("detail","show"));
                    // return $this->render("detail/form_detail.php");

                } else {
                    // Gestion d'une éventuelle erreur lors de l'ajout de la réservation
                    $errors = ["Une erreur s'est produite lors de l'ajout de la réservation."];
                }
            }

        }
        // Récupère les erreurs du formulaire
        $errors = $this->form->getEerrorsForm();

        return $this->render("detail/form_detail.php",$data + [
            'detail' => $detail,
            "errors" => $errors
        ]);
    }      

  
    public function deleteDetail($id)
    {
        // Annule la réservation
        $success = $this->detailRepository->deleteDetail($id);

        if ($success) {
        // d_die($bookings);

        // Redirige vers le tableau de bord
        return redirection(addLink("detail","dashUsers"));

        } else {
            // Récupére les erreurs du formulaire
            $errors = $this->form->getEerrorsForm();
            return $this->render("bookings/form_bookings.php", [
                "errors" => $errors
            ]);
        
        }
    }
}