<?php

namespace Controller;

use Model\Entity\Rooms;
use Model\Entity\Detail;
use Service\CartManager;
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
        try {
            $cm = new CartManager();

            // Appeler la méthode addCart avec l'identifiant 
            $cm->addCart($id);
            // d_die($cm);
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

}