<?php

namespace Controller;

use Model\Entity\Rooms;
use Form\RoomsHandleRequest;
use Model\Repository\RoomsRepository;
use Controller\BaseController;

class HomeController extends BaseController
{
    private RoomsRepository $roomsRepository;
    // private RoomsHandleRequest $form;
    private Rooms $rooms;

    public function __construct()
    {
        $this->roomsRepository = new RoomsRepository;
        // $this->form = new RoomsHandleRequest;
        $this->rooms = new Rooms;
    }
    public function list()
    {
        $roomss = $this->roomsRepository->findAll($this->rooms);
        $this->render("home.php", [
            "h1" => "Liste des chambres",
            "roomss" => $roomss
        ]);
    }
}