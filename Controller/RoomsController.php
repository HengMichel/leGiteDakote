<?php
/**
 * Summary of namespace Controller
 */
namespace Controller;

use Model\Repository\RoomsRepository;

/**
 * Summary of RoomsController
 */
class RoomsController extends BaseController
{
    public function list()
    {
        error("404.php");
    }
    
    public function show($id)
    {
        if (!empty($id) && is_numeric($id)) {            
            $pr = new RoomsRepository;
            $rooms = $pr->findById('rooms', $id);
                if (empty($rooms)) {
                $this->setMessage("danger",  "Le produit NO $id n'existe pas");
                redirection(addLink("home"));
            }
            $this->render("rooms/show.html.php", [
            "rooms" => $rooms,
            "h1" => "Fiche rooms"
            ]);
        } else {
            error("404.php");
        }
    }
}