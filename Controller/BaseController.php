<?php

namespace Controller;

use Service\Session;


abstract class BaseController
{
    public function render(string $fichier, array $parametres = [])
    {
        extract($parametres);
        include "public/header.php";
        include "views/$fichier";
        include "public/footer.php";
    }

    public function getUsers()
    {
        $users = Session::isConnected();

        if (!$users) {
            redirection("/error/403.php");
        }
        return $users;
    }

    public function getAdmin()
    {
        $users = Session::isAdmin();

        if (!$users) {
            redirection("/error/403.php");
        }
        return $users;
    }

    public function setMessage($type, $message)
    {
        Session::addMessage($type, $message);
    }
}
