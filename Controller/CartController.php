<?php

namespace Controller;

use Model\Entity\Rooms;
use Model\Entity\Detail;
use Service\CartManager;
use Form\CartHandleRequest;
use Model\Repository\RoomsRepository;
use Model\Repository\DetailRepository;

class CartController extends BaseController
{
    private $roomsRepository;
    private $detailRepository;
    private $form;
    private $rooms;
    private $detail;

    public function __construct()
    {
        $this->detailRepository = new DetailRepository;
        $this->roomsRepository = new RoomsRepository;
        $this->form = new CartHandleRequest;
        $this->rooms = new Rooms;
        $this->detail = new Detail;
    }

    /**
     * Summary of add
     * @param mixed $id
     * @return void
     */
    public function addToCart($id)
    {   
        $cm = new CartManager();
        $cm->addCart($id);
        // $nb = $cm->addCart($id);
        // echo $nb;        
    }
    /**
     * Summary of show
     * @return void
     */

    //  public function showCart()
    //  {
    //      $detail = new Detail;
    //      $detail = $this->detailRepository->findAll($detail);
 
    //      return $this->render("cart/form_cart.php", [            
    //      "h1" => "Date de réservation",
    //      'detail' => $detail,
    //      ]);
    //  }

     public function detailCart()
     {
        return $this->render("cart/form_cart.php", [            
         "h1" => "Date de réservation"
        ]);
     }


    public function show($id)
    {
        if (!empty($id) && is_numeric($id)) 
        {   
    //         // Récupère les paramètres POST
            // $user_id = $_POST['user_id'] ?? null;
            // d_die($room_id,);

    //         // Converti l'ID en entier
            $id = intval($id); 
//             // d_die($id);  

// Instancie la classe DetailsRepository pour interagir avec la base de données
            $d = new DetailRepository;

// Appele de la méthode findRoomsById pour récupérer les informations de la chambre par son ID
            $id = $d->findDetailById($id);
//             d_die($id);  

//             // d_die($room);
//             // Vérifie si la chambre existe
            if (empty($detail)) {
                $this->setMessage("danger",  "Le produit N° $id n'existe pas");
                redirection(addLink("home"));
            }
// Affiche la vue de détails de la chambre avec les informations récupérées
            $this->render("cart/form_cart.php", [
            "detail" => $detail,
            "h1" => "Fiche de la chambre"
            ]);
        } else {
            // Redirige vers une page d'erreur si l'ID n'est pas valide
            error("404.php");
        }

    }
    
// #################################################################
//  methode a faire pour le panier
    public function newPanier($id){
        
        // Instancie l'objet Detail avec les données appropriées
        $detail = new Detail();
        
        $this->form->handleFormCart($detail);

        if ($detail instanceof Detail) {
            $detail->setRoom_id($detail->getRoom_id());
       }

        // Vérifie si le formulaire est soumis
        if ($this->form->isSubmitted()) {
        // d_die($detail);
    
            // Vérifie s'il n'y a pas d'erreurs dans les données soumises
            if ($this->form->isValid()) {
            // d_die($_SESSION);
            // d_die($detail);
    
                // Ajoute la réservation à la base de données
                $success = $this->detailRepository->findDetailById($id);
                // d_die($success); 
                // return bool(true)

                if ($success) {
                // d_die($_SESSION);
                // d_die($detail);
                return redirection(addLink("cart","addToCart"));
                } else {
    //             // Récupére les erreurs du formulaire
                $errors = $this->form->getEerrorsForm();
                return $this->render("bookings/form_bookings.php", [
                    "errors" => $errors
                ]);
                }
            }
        }    
    }      

    


    /**
     * Summary of edit
     * @param mixed $id
     * @return void
     */
    public function edit($id)
    {
        
    }

    public function delete($id)
    {
        
    }

}