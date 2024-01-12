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

            $r = new RoomsRepository;
            $rooms = $r->findRoomsById($id);

            // d_die($room);
            
                if (empty($rooms)) {
                $this->setMessage("danger",  "Le produit N° $id n'existe pas");
                redirection(addLink("home"));
            }
            $this->render("rooms/show.php", [
            "rooms" => $rooms,
            "h1" => "Fiche de la chambre"
            ]);
        } else {
            error("404.php");
        }

    }
}