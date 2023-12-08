<?php

namespace Controller\Admin;

use Model\Entity\Rooms;
use Form\Admin\AdminRoomsHandleRequest;
use Controller\BaseController;
use Model\Repository\Admin\AdminRoomsCrudRepository;

class AdminRoomsController extends BaseController
{
    private $roomsRepository;
    private $form;
    private $rooms;

    public function __construct()
    {
        $this->roomsRepository = new AdminRoomsCrudRepository;
        $this->form = new AdminRoomsHandleRequest;
        $this->rooms = new Rooms;
    }
    public function newRooms()
    {
        $rooms = $this->rooms;
        $this->form->handleForm($rooms);

        if ($this->form->isSubmitted() && $this->form->isValid()) {
            $this->roomsRepository->addRooms($rooms);
            return redirection(addLink("Admin"/"rooms"));
        }

        $errors = $this->form->getEerrorsForm();

        return $this->render("admin/dashboard_admin.php",  [
            "rooms" => $rooms,
            "errors" => $errors
        ]);
    }

    public function deleteRooms($id)
    {
        $roomss = $this->roomsRepository->deleteRoomsById($this->rooms);
        $this->roomsRepository->deleteRoomsById($id);

        return redirection(addLink("admin/dashboard_admin.php"));

    }
}