<?php
namespace Controller\Admin;
// namespace Controller;

use Model\Entity\Rooms;
use Controller\BaseController;
use Model\Repository\UsersRepository;
use Form\Admin\AdminRoomsHandleRequest;
use Model\Repository\Admin\AdminRepository;

class AdminController extends BaseController
{
    private $roomsRepository;
    private $usersRepository;
    private $form;
    private $rooms;
    private $users;


    public function __construct()
    {
        $this->roomsRepository = new AdminRepository;
        $this->usersRepository = new UsersRepository;
        $this->form = new AdminRoomsHandleRequest;
        $this->rooms = new Rooms;
    }

    public function home()
    {
        $userss = $this->usersRepository->findAll($this->users);

        $this->render("admin/dashboard_admin.php", [
            "userss" => $userss
        ]);
    }

    public function newRooms()
    {
        $rooms = $this->rooms;
        $this->form->handleForm($rooms);

        if ($this->form->isSubmitted() && $this->form->isValid()) {
            $this->roomsRepository->addRooms($rooms);
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