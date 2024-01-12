<?php
namespace Controller\Admin;
// namespace Controller;

// ##########  code provenant de AdminController.php

use Model\Entity\Rooms;
use Service\ImageHandler;
use Controller\BaseController;
use Form\RoomsHandleRequest;
use Model\Repository\RoomsRepository;
use Model\Repository\UsersRepository;
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
        $this->form = new RoomsHandleRequest;
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


// ############## code Mitra + modif  ##############
    /**
     * Summary of edit
     * @param mixed $id
     * @return void
     */
    public function edit($id)
    {
        if (!empty($id) && is_numeric($id)) {

            /**
             * @var Rooms
             */
            $rooms = $this->rooms;

            $this->form->handleForm($rooms);

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
    // public function deleteRooms($id)
    // {
    //     $roomss = $this->roomsRepository->deleteRoomsById($this->rooms);
    //     $this->roomsRepository->deleteRoomsById($id);

    //     return redirection(addLink("admin/dashboard_admin.php"));

    // }

    public function deleteRooms($id)
    {
        if (!empty($id) && $id > 0) {
            if (is_numeric($id)) {

                $rooms = $this->rooms;
            } else {
                $this->setMessage("danger",  "ERREUR 404 : la page demandé n'existe pas");
            }
        } else {
            $this->setMessage("danger",  "ERREUR 404 : la page demandé n'existe pas");
        }

        $this->render("rooms/form.php", [
            "h1" => "Suppresion du produit n°$id ?",
            "rooms" => $rooms,
            "mode" => "suppression"
        ]);
    }

    public function show($id)
    {
        if ($id) {
            if (is_numeric($id)) {

                $rooms = $this->roomsRepository->findRoomsById($id);
                
            } else {
                $this->setMessage("danger",  "Erreur 404 : cette page n'existe pas");
            }
        } else {
            $this->setMessage("danger",  "Erreur 403 : vous n'avez pas accès à cet URL");
            redirection(addLink("rooms", "list"));
        }

        $this->render("rooms/show.php", [
            "rooms" => $rooms,
            "h1" => "Fiche de la chambre"
        ]);
    }

    // ############## code Mitra + modif  ##############
}