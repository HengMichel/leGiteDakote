<?php

namespace Controller;

use Model\Entity\Rooms;
use Controller\BaseController;
use Model\Repository\RoomsRepository;

class RoomsController extends BaseController
{
    private $roomsRepository;
    private $rooms;

    public function __construct()
    {
        $this->roomsRepository = new RoomsRepository;
        $this->rooms = new Rooms;
    }
    public function list(){

        $roomss = $this->roomsRepository->findAll($this->rooms);

        $this->render("rooms/list_rooms.php", [
            "roomss" => $roomss
        ]);
    }
    
}

    