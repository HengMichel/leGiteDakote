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

    public function CoUsers($users)
    {
        $userss = $this->usersRepository->logUsers($this->users);
        $this->usersRepository->logUsers($users);
        return redirection(addLink("users/dashboard_users.php"));
    }

    public function decoUsers($users)
    {
        $userss = $this->usersRepository->logoutUsers($this->users);
        $this->usersRepository->logoutUsers($users);
        return redirection(addLink("home"));
    }


}
