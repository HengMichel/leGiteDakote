<?php

namespace Controller;

use Model\Entity\Rooms;
use Model\Entity\Details;
use Service\CartManager;
use Model\Repository\RoomsRepository;
use Model\Repository\DetailsRepository;

class CartController extends BaseController
{
    private $roomsRepository;
    private $detailsRepository;
    private $form;
    private $rooms;
    private $details;

    public function __construct()
    {
        $this->detailsRepository = new DetailsRepository;
        $this->roomsRepository = new RoomsRepository;
        $this->rooms = new Rooms;
        $this->details = new Details;
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

            // Appel de la méthode addCart avec l'identifiant 
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
            $d = new DetailsRepository;

            // Appele de la méthode findRoomsById pour récupérer les informations de la chambre par son ID
            $id = $d->findDetailById($id);
            //  d_die($id);  

            // Vérifie si la chambre existe
            if (empty($details)) {
                $this->setMessage("danger",  "Le produit N° $id n'existe pas");
                redirection(addLink("home"));
            }
            // Affiche la vue de détails de la chambre avec les informations récupérées
            $this->render("cart/form_cart.php", [
            "detail" => $details,
            "h1" => "Fiche de la chambre"
            ]);
        } else {
            // Redirige vers une page d'erreur si l'ID n'est pas valide
            error("404.php");
        }
    }

}