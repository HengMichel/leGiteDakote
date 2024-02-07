<?php

namespace Controller;

use Model\Repository\RoomsRepository;

class RoomsController extends BaseController
{

    private $roomsRepository;

    public function __construct()
    {
        $this->roomsRepository = new RoomsRepository;
        
    }

    public function list()
    {
        error("404.php");
    }
    
    public function show($id)
    {
        if (!empty($id) && is_numeric($id)) 
        {   
            
            // Converti l'ID en entier
            $id = intval($id); 
            // d_die($id);  

            // Instancie la classe RoomsRepository pour interagir avec la base de données
            $r = new RoomsRepository;

            // Appele de la méthode findRoomsById pour récupérer les informations de la chambre par son ID
            $rooms = $r->findRoomsById($id);

            // d_die($room);
                // Vérifie si la chambre existe
                if (empty($rooms)) {
                $this->setMessage("danger",  "Le produit N° $id n'existe pas");
                redirection(addLink("home"));
            }
            // Affiche la vue de détails de la chambre avec les informations récupérées
            $this->render("rooms/show.php", [
            "rooms" => $rooms,
            "h1" => "Fiche de la chambre"
            ]);
        } else {
            // Redirige vers une page d'erreur si l'ID n'est pas valide
            error("404.php");
        }

    }

}