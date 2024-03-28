<?php

namespace Controller;

use Model\Entity\Rooms;
use Model\Entity\Detail;
use Service\CartManager;
use Form\CartHandleRequest;
use Form\DetailHandleRequest;
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
        // $this->form = new DetailHandleRequest;
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
        // d_die($_POST);
        // array(6) {
        //   ["id_room"]=>
        //   string(2) "25"
        //   ["price"]=>
        //   string(2) "50"
        //   ["redirect_url"]=>
        //   string(27) "/leGiteDakote/rooms/show/25"
        //   ["booking_start_date"]=>
        //   string(10) "2024-03-29"
        //   ["booking_end_date"]=>
        //   string(10) "2024-03-30"
        //   ["passerLaCommande"]=>
        //   string(0) ""
        // }
        try {
            $cm = new CartManager();

            // Appeler la méthode addCart avec l'identifiant 
            $cm->addCart($id);
            // Redirection en cas de succès
            $redirectUrl = $_POST['redirect_url'] ?? addLink("cart", "detailCart");
            header("Location: $redirectUrl");
            exit();
        } catch (\Exception $e) {
            // Gestion des erreurs
            $_SESSION['error'] = $e->getMessage();
            $redirectUrl = $_POST['redirect_url'] ?? addLink("cart", "detailCart");
            header("Location: $redirectUrl");
            exit();
        }
    }

    /**
     * Summary of show
     * @return void
     */
    public function detailCart()
    {
       return $this->render("cart/form_cart.php", [            
        "h1" => "Date de réservation"
       ]);
       
    }

    /**
     * Summary of add
     * @param mixed $id
     * @return void
     */
    public function delectToCart($roomId)
    {   
        $cm = new CartManager();
        $cm->cancelCart($roomId);
    }

    public function show($id)
    {
        if (!empty($id) && is_numeric($id)) 
        {   
            // Converti l'ID en entier
            $id = intval($id); 
            // d_die($id);  

            // Instancie la classe DetailsRepository pour interagir avec la base de données
            $d = new DetailRepository;

            // Appele de la méthode findRoomsById pour récupérer les informations de la chambre par son ID
            $id = $d->findDetailById($id);
            //  d_die($id);  

            // Vérifie si la chambre existe
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
        
        // $this->form->handleFormCart($detail);

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