<?php

namespace Controller;

use Model\Entity\Rooms;
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
        $this->rooms = new Rooms;
    }

    public function serviceDuGite()
    {
        $this->render("serviceDuGite.php");
    }

    public function aboutUs()
    {
        $this->render("aboutUs.php");
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