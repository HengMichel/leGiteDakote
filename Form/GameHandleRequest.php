<?php

namespace Form;

use Model\Entity\Game;
use Model\Repository\GameRepository;

class GameHandleRequest extends BaseHandleRequest
{
    private $gameRepository;

    public function __construct()
    {
        $this->gameRepository  = new GameRepository;
    }

    public function handleForm(Game $game)
    {
        if (isset($_POST['submit'])) {

            extract($_POST);
            $errors = [];

            // Vérification de la validité du formulaire
            if (empty($title)) {
                $errors[] = "Le titre ne peut pas être vide";
            }
            if (strlen($title) < 1) {
                $errors[] = "Le titre doit avoir au moins 1 caractères";
            }
            if (strlen($title) > 100) {
                $errors[] = "Le titre ne peut avoir plus de 100 caractères";
            }

            // Est-ce que le pseudo existe déjà dans la bdd ?

            // $requete = $this->userRepository->findByPseudo($pseudo);
            $requete = $this->gameRepository->findByAttributes($game, ["title" => $title]);
            if ($requete) {
                $errors[] = "Le titre existe déjà, veuillez en choisir un nouveau";
            }

            if (!empty($min_players)) {
                if (strlen($min_players) < 1) {
                    $errors[] = "Le min_players doit avoir au moins 1 caractères";
                }
                if (strlen($min_players) > 4) {
                    $errors[] = "Le min_players ne peut avoir plus de 4 caractères";
                }
            }
            if (!empty($max_players)) {
                if (strlen($max_players) < 1) {
                    $errors[] = "Le max_players doit avoir au moins 2 caractères";
                }
                if (strlen($max_players) > 30) {
                    $errors[] = "Le max_players ne peut avoir plus de 30 caractères";
                }
            }
            
            if (empty($errors)) {
              
                $game->setTitle($title);
                $game->setMin_players($min_players);
                $game->setMax_players($max_players);
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