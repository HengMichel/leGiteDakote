<?php

namespace Controller;

use Model\Repository\RoomsRepository;

class RoomsController extends BaseController
{
    public function list()
    {
        error("404.php");
    }
    
    public function show($id)
    {
        if (!empty($id) && is_numeric($id)) 
        {   
            
            // Convertir l'ID en entier
            $id = intval($id); 
            // d_die($id);  

            // Instancier la classe RoomsRepository pour interagir avec la base de données
            $r = new RoomsRepository;

            // Appeler la méthode findRoomsById pour récupérer les informations de la chambre par son ID
            $rooms = $r->findRoomsById($id);

            // d_die($room);
                // Vérifier si la chambre existe
                if (empty($rooms)) {
                $this->setMessage("danger",  "Le produit N° $id n'existe pas");
                redirection(addLink("home"));
            }
            // Afficher la vue de détails de la chambre avec les informations récupérées
            $this->render("rooms/show.php", [
            "rooms" => $rooms,
            "h1" => "Fiche de la chambre"
            ]);
        } else {
            // Rediriger vers une page d'erreur si l'ID n'est pas valide
            error("404.php");
        }

    }
}