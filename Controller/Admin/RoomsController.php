<?php
namespace Controller\Admin;
// namespace Controller;

// ##########  code provenant de AdminController.php

use Model\Entity\Rooms;
use Service\ImageHandler;
use Controller\BaseController;
use Model\Repository\RoomsRepository;
use Model\Repository\UsersRepository;
use Form\Admin\AdminRoomsHandleRequest;
// use Model\Repository\Admin\AdminRepository;

class RoomsController extends BaseController
{
    private $roomsRepository;
    private $usersRepository;
    private $form;
    private $rooms;
    private $users;


    public function __construct()
    {
        // $this->roomsRepository = new AdminRepository;
        $this->roomsRepository = new RoomsRepository;
        $this->usersRepository = new UsersRepository;
        $this->form = new AdminRoomsHandleRequest;
        $this->rooms = new Rooms;
    }

    public function home()
    {
        // $userss = $this->usersRepository->findAll($this->users);

        // $this->render("admin/dashboard_admin.php", [
        //     "userss" => $userss
        // ]);

        // ##### ou retour a la liste des chambres home.php ######
        $roomss = $this->roomsRepository->findAll($this->users);

        $this->render("home", [
            "h1" => "Liste des chambres",
            "roomss" => $roomss
        ]);
    }
    
    public function newRooms()
    {
        $rooms = $this->rooms;
        $this->form->handleForm($rooms);

        if ($this->form->isSubmitted() && $this->form->isValid()) {

            // ajout code ici pour le changement du chemin pour les images via le repertoire uploads et a l aide de Service ImageHandler.php
            ImageHandler::handelPhoto($rooms);
  
            // new methode pour ajouter les rooms
            $this->roomsRepository->insertRooms($rooms);

            // $this->roomsRepository->addRooms($rooms);

            return redirection(addLink("admin","rooms"));
        }

        $errors = $this->form->getEerrorsForm();

        return $this->render("admin/form_rooms.php",  [
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