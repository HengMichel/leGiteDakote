<?php
namespace Controller\Admin;

use Model\Entity\Users;
use Form\UsersHandleRequest;
use Controller\BaseController;
use Model\Repository\UsersRepository;


class UsersController extends BaseController{

    private $usersRepository;
    private $form;
    private $users;

    public function __construct()
    {
        $this->usersRepository = new UsersRepository;
        $this->form = new UsersHandleRequest;
        $this->users = new Users;
    }

    public function list()
    {
        $userss = $this->usersRepository->findAll($this->users);

        $this->render("users/list_users.php", [
            "userss" => $userss
        ]);
    }

    public function deleteUsers($id)
    {
        // $players = $this->usersRepository->deleteUsersById($this->users);
        // $this->usersRepository->deleteUsersById($id);
        // return redirection(addLink("users"));
    }

  
}