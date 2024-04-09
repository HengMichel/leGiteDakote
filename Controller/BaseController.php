<?php

namespace Controller;

use Service\Session;


abstract class BaseController
{
    // Méthode pour rendre une vue avec un fichier spécifié et des paramètres
    public function render(string $fichier, array $parametres = [])
    {
        extract($parametres);
        include "public/header.php";
        include "views/$fichier";
        include "public/footer.php";
    }

    // Méthode pour obtenir l'utilisateur connecté
    public function getUsers()
    {
        $users = Session::isConnected();
        if (!$users) 
        {
            redirection("/error/403.php");
        }
        return $users;
    }

    // Méthode pour obtenir l'administrateur connecté
    public function getAdmin()
    {
        $users = Session::isAdmin();
        if (!$users) 
        {
            redirection("/error/403.php");
        }
        return $users;
    }

    // Méthode pour définir un message dans la session

    /**
     * Summary of setMessage
     *
     * @param  mixed $type
     * @param  mixed $message
     * @return void
     */
    public function setMessage($type, $message)
    {
        Session::addMessage($type, $message);
    }

    // peut etre utile plus tard
    public function disconnection()
    {
        Session::logout();
    }
    
    public function remove($value)
    {
        Session::delete($value);
    }

    public function redirectToRoute(array $linkInfo)
    {
        $controller = $linkInfo[0];
        $method = $linkInfo[1]?? null;
        $id = $linkInfo[2]?? null;
        redirection(addLink($controller, $method, $id));
    }
}
