<?php

namespace Controller;

use Model\Entity\Rooms;
use Model\Repository\RoomsRepository;
use Controller\BaseController;

class HomeController extends BaseController
{
    private RoomsRepository $roomsRepository;
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

        if (isset($_SERVER['HTTP_ACCEPT']) && strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false) {

            // Si c'est une requête AJAX, renvoye les données JSON
            $category = $_POST['choix'];
            $jsonResult = $this->roomsRepository->findRoomsByCategoryJson($category);
        
            echo $jsonResult;

            exit();
        }
        // Si ce n'est pas une requête AJAX ou si la catégorie n'est pas spécifiée, affiche la page normalement
        $roomss = $this->roomsRepository->findAll($this->rooms);

        $this->render("home.php", [
            "h1" => "Liste des chambres",
            "roomss" => $roomss
        ]);
    }

}