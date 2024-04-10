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
// d_die($rooms);
        if ($this->form->isSubmitted() && $this->form->isValid()) {
// d_die($rooms);
            // ici pour le changement du chemin pour les images via le repertoire uploads et a l aide de Service ImageHandler.php
            ImageHandler::handelPhoto($rooms);
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
    /**
     * Summary of edit
     * @param mixed $id
     * @return void
     */
    public function edit($id)
    {
        if (!empty($id) && is_numeric($id)) 
        {
            /**
             * @var Rooms
             */
            $rooms = $this->rooms;
            $this->form->RoomsHandleForm($rooms);
            if ($this->form->isSubmitted() && $this->form->isValid()) {
                $this->roomsRepository->updateRooms($rooms);
                return redirection(addLink("home"));
            }
            $errors = $this->form->getEerrorsForm();
            return $this->render("rooms/form.php", [
                "h1" => "Update de l'utilisateur n° $id",
                "rooms" => $rooms,
                "errors" => $errors
            ]);
        }
        return redirection("/errors/404.php");
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

    public function editRoom($id)
    {
        // Récupérer les détails de la chambre à partir de l'identifiant $id
        $room = $this->roomsRepository->findRoomsById($id);
// d_die($room);
        // Passer les détails de la chambre à la vue
        $this->render("admin/edit_room_form.php", [
            "h1" => "Modifier la chambre",
            "room" => $room
        ]);
    }

    public function updateRoom($id)
{
    // Récupérer les détails de la chambre à partir de l'identifiant $id
    $room = $this->roomsRepository->findRoomsById($id);
d_die($room);
    // Vérifier si la chambre existe
    if ($room) {
        // Gérer les données du formulaire
        $this->form->EditRoomHandleForm($room);
    // d_die($this->form->EditRoomHandleForm($room));

        // Vérifier si le formulaire est soumis et valide
        if ($this->form->isSubmitted() && $this->form->isValid()) {
            // Gérer les images
            ImageHandler::handelPhoto($room);

            // Mettre à jour la chambre dans la base de données
            $success = $this->roomsRepository->updateRoomById($room);

            if ($success) {
                // Redirection avec un message de succès
                $this->setMessage("success",  "Mise à jour de la chambre réussie");
                return redirection(addLink("admin","rooms","list"));
            } else {
                // Message d'erreur en cas d'échec de la mise à jour
                $this->setMessage("danger",  "Erreur lors de la mise à jour de la chambre");     
            }
        }
    } else {
        // Chambre non trouvée, afficher un message d'erreur
        $this->setMessage("danger",  "Chambre non trouvée");
    }
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
}