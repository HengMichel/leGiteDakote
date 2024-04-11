<?php
namespace Controller\Admin;

use Model\Entity\Rooms;
use Service\ImageHandler;
use Controller\BaseController;
use Form\RoomsHandleRequest;
use Model\Repository\RoomsRepository;

class RoomsController extends BaseController
{
    private $roomsRepository;
    private $form;
    private $rooms;

    public function __construct()
    {
        $this->roomsRepository = new RoomsRepository;
        $this->form = new RoomsHandleRequest;
        $this->rooms = new Rooms;
    }

    public function list()
    {
        $rooms = $this->roomsRepository->findAll($this->rooms);
        $this->render("admin/list_rooms.php", [
            "h1" => "Liste des chambres",
            "rooms" => $rooms
        ]);
    }
    
    public function newRooms()
    {
        $rooms = $this->rooms;
        $this->form->RoomsHandleForm($rooms);
        d_die($rooms);
        if ($this->form->isSubmitted() && $this->form->isValid()) 
        {
        d_die($rooms);
            // ici pour le changement du chemin pour les images via le repertoire uploads et a l aide de Service ImageHandler.php
            ImageHandler::handelPhoto($rooms);
            d_die($rooms);

            // new method for add rooms insertRooms($rooms)
            $this->roomsRepository->insertRooms($rooms);
            return redirection(addLink("admin","rooms"));
        }
        $errors = $this->form->getEerrorsForm();
        return $this->render("admin/form_rooms.php",  [
            "rooms" => $rooms,
            "errors" => $errors
        ]);
    }











    public function editRoom($id)
    {
        // Récupérer les détails de la chambre à partir de l'identifiant $id
        $rooms = $this->roomsRepository->findRoomsById($id);
        // d_die($rooms);
        // Passer les détails de la chambre à la vue
        $this->render("admin/edit_room_form.php", [
            "h1" => "Modifier la chambre",
            "rooms" => $rooms
        ]);
    }

    public function updateRoom($id)
    {        
        $rooms = $this->roomsRepository->findRoomsById($id);
        // d_die($rooms);
        $this->form->RoomsHandleForm($rooms);
        // d_die($rooms);
        if ($this->form->isSubmitted() && $this->form->isValid()) 
        // d_die($this->form);
        {
            // d_die($rooms);
            // ici pour le changement du chemin pour les images via le repertoire uploads et a l aide de Service ImageHandler.php
            ImageHandler::handelPhoto($rooms);
            // new method for add rooms insertRooms($rooms)
            $this->roomsRepository->updateRoom($rooms);
            return redirection(addLink("admin","rooms"));
        }
        $errors = $this->form->getEerrorsForm();
        return $this->render("admin/edit_room_form.php",  [
            "rooms" => $rooms,
            "errors" => $errors
        ]);
    }



















    public function show($id)
    {
        if ($id) {
            if (is_numeric($id)) 
            {
                $rooms = $this->roomsRepository->findRoomsById($id); 
            } else 
            {
                $this->setMessage("danger",  "Erreur 404 : cette page n'existe pas");
            }
        } else 
        {
            $this->setMessage("danger",  "Erreur 403 : vous n'avez pas accès à cet URL");
            redirection(addLink("rooms", "list"));
        }
        $this->render("rooms/show.php", [
            "rooms" => $rooms,
            "h1" => "Fiche de la chambre"
        ]);
    }

    public function deleteRooms($id)
    {
        $success =  $this->roomsRepository->deleteRoomsById($id);
        if ($success) 
        { 
            $this->setMessage("succes",  "Suppresion de la chambre n°$id ");
        } else 
        {
            $this->setMessage("danger",  "ERREUR 404 : la page demandé n'existe pas");     
        }
        return redirection(addLink("admin","rooms","list"));
    }
}