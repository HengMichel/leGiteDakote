<?php

namespace Controller;

use Model\Entity\Users;
use Model\Repository\UsersRepository;
use Form\UsersHandleRequest;

class UsersController extends BaseController
{
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

    public function newUsers()
    {
        $users = $this->users;
        $this->form->handleForm($users);

        if ($this->form->isSubmitted() && $this->form->isValid()) {
            $this->usersRepository->addUsers($users);
            return redirection(addLink("users/login"));
        }

        $errors = $this->form->getEerrorsForm();

        return $this->render("users/form_users.php", [
            "users" => $users,
            "errors" => $errors
        ]);
    }

    public function deleteUsers($id)
    {
        $players = $this->usersRepository->deleteUsersById($this->users);
        $this->usersRepository->deleteUsersById($id);
        return redirection(addLink("users"));
    }

    // public function modifPlayer($player)
    // {
    //     $players = $this->playerRepository->updatePlayer($this->player);
    //     $this->playerRepository->updatePlayer($player);
    //     return redirection(addLink("player"));
    // }


}
