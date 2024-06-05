<?php

namespace Controller;

use Model\Entity\Details;
use Service\CartManager;
use Model\Repository\DetailsRepository;

class CartController extends BaseController
{
    private $detailsRepository;
    private $details;

    public function __construct()
    {
        $this->detailsRepository = new DetailsRepository;
        $this->details = new Details;
    }
    /**
     * Summary of add
     * @param mixed $id
     * @return void
     */
    public function addToCart($id)
    {          
        try 
        {
            $cm = new CartManager();
            // Appel de la méthode addCart avec l'identifiant 
            $cm->addCart($id);
            // d_die($cm);
            // Redirection en cas de succès
            return $this->render("cart/form_cart.php", [ 
                        "h1" => "Date de réservation"
                    ]);  
            exit();
        } catch (\Exception $e) 
        {
            // Gestion des erreurs 
            $_SESSION['error'] = $e->getMessage();
            // aucune redirection on reste sur la meme page avec le message d'erreur affiché
            $redirectUrl = $_POST['redirect_url'];
            header("Location: $redirectUrl");
            exit();
        }  
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
            $d = $this->detailsRepository ;
            // Appele de la méthode findDetailByBookingId pour récupérer les informations de la chambre par son ID
            $id = $d->findDetailByBookingId($id);
            //  debug($id);  
            // Vérifie si la chambre existe
            if (empty($this->details)) 
            {
                $this->setMessage("danger",  "Le produit N° $id n'existe pas");
                redirection(addLink("home"));
            }
            // Affiche la vue de détails de la chambre avec les informations récupérées
            $this->render("cart/form_cart.php", [
            "detail" => $this->details,
            "h1" => "Fiche de la chambre"
            ]);
        } else 
        {
            // Redirige vers une page d'erreur si l'ID n'est pas valide
            error("404.php");
        }
    }
}