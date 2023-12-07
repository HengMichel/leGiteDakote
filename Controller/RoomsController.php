<?php

namespace Controller;

use Model\Entity\Rooms;
use Form\RoomsHandleRequest;
use Controller\BaseController;
use Controller\RoomsCrudController;

class RoomsController extends BaseController
{
    private $roomsRepository;
    private $form;
    private $rooms;

    public function __construct()
    {
        $this->roomsRepository = new RoomsCrudController;
        $this->form = new RoomsHandleRequest;
        $this->rooms = new Rooms;
    }
    public function list(){

        $roomss = $this->roomsRepository->findAll($this->rooms);

        $this->render("rooms/list_rooms.php", [
            "roomss" => $roomss
        ]);
    }

    public function newRooms()
    {
        $rooms = $this->rooms;
        $this->form->handleForm($rooms);

        if ($this->form->isSubmitted() && $this->form->isValid()) {
            $this->roomsRepository->addRooms($rooms);
            return redirection(addLink("rooms"));
        }

        $errors = $this->form->getEerrorsForm();

        return $this->render("rooms/form_rooms.php",  [
            "rooms" => $rooms,
            "errors" => $errors
        ]);
    }

   

    public function deleteRooms($id)
    {
        $roomss = $this->roomsRepository->deleteRoomsById($this->rooms);
        $this->roomsRepository->deleteRoomsById($id);

        return redirection(addLink("rooms"));

    }

}

    