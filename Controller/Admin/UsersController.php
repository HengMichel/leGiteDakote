<?php
namespace Controller\Admin;

use Model\Entity\Users;
use Controller\BaseController;
use Model\Repository\UsersRepository;

class UsersController extends BaseController
{
    private $usersRepository;
    private $users; 

    public function __construct()
    {
        $this->usersRepository = new UsersRepository;
        $this->users = new Users;
    }

    public function list()
    {
        $users = $this->usersRepository->findAll($this->users);

        $this->render("admin/list_users.php", [
            "h1" => "Liste des utilisateurs",
            "users" => $users
        ]);
    }
    public function dashboard()
    {
        $users = $this->usersRepository->findAll($this->users);

        $this->render("admin/dashboard_admin.php", [
            "h1" => "Dashboard",
            "users" => $users
        ]);
    }
}