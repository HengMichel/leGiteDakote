<?php

namespace Form;

use Model\Entity\Contest;
use Model\Repository\ContestRepository;


class ContestHandleRequest extends BaseHandleRequest
{
    private $contestRepository;

    public function __construct()
    {
        $this->contestRepository  = new ContestRepository;
    }

    public function handleForm(Contest $contest)
    {
        if (isset($_POST['submit'])) {

            extract($_POST);
            $errors = [];

            // Vérification de la validité du formulaire

           
            if (empty($game_id)) {
                if (strlen($game_id)) {
                    $errors[] = "game_id ne peut pas être vide";
                }
            }
            if (empty($start_date)) {
                if (strlen($start_date)) {
                    $errors[] = "Le start_date ne peut pas être vide";
                }
            }
            if (empty($winner_id)) {
                if (strlen($winner_id)) {
                    $errors[] = "Le winner_id ne peut pas être vide";
                }
            }
            
            if (empty($errors)) {
              
                $contest->setGame_id($game_id);
                $contest->setStart_date($start_date);
                $contest->setWinner_id($winner_id);
                return true;
            }

            $this->setEerrorsForm($errors);
        }
    }

    // public function handleUpdate($id)
    // {
    //     if (isset($_GET['idUser'])) {

    //         $idUser = htmlspecialchars($_GET['idUser']);
        
    //         User::UserById($idUser);
    //     }
    // }
    public function handleSecurity()
    {
       
        
    }
}