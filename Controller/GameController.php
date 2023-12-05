<?php

namespace Controller;

use Model\Entity\Game;
use Model\Entity\Contest;
use Form\GameHandleRequest;
use Controller\BaseController;
use Model\Repository\GameRepository;

class GameController extends BaseController
{
    private $gameRepository;
    private $form;
    private $game;

    public function __construct()
    {
        $this->gameRepository = new GameRepository;
        $this->form = new GameHandleRequest;
        $this->game = new Game;
    }
    public function list(){

        $games = $this->gameRepository->findAll($this->game);

        // $this->render("game/list_game.php");
        $this->render("game/list_game.php", [
            "games" => $games
        ]);
    }

    public function newGame()
    {
        $game = $this->game;
        $this->form->handleForm($game);

        if ($this->form->isSubmitted() && $this->form->isValid()) {
            $this->gameRepository->addGame($game);
            return redirection(addLink("game"));
        }

        $errors = $this->form->getEerrorsForm();

        return $this->render("game/form_game.php",  [
            "game" => $game,
            "errors" => $errors
        ]);
    }

   

    public function deleteGame($id)
    {
        // $game = Game::deleteGameById($id);
        // $this->render("game/list_game.php");

        $games = $this->gameRepository->deleteGameById($this->game);
        $this->gameRepository->deleteGameById($id);

        return redirection(addLink("game"));

    }

    
    

    // public function addContest($game_id, $start_date, $winner_id)
    // {
    //     Contest::addContest($game_id, $start_date, $winner_id);

        // gérer la réponse ou la redirection
    //     $this->render("contest/add_contest.php");

    // }

  
}

// Exemple d'utilisation :
// $gameController = new GameController();

// if (isset($_GET['id_game_delete'])) {    
//     $gameController->deleteGameById($_GET['id_game_delete']);
// } elseif (isset($_POST['add_game'])) {
//     $gameController->newGame($_POST['title'], $_POST['min_players'], $_POST['max_players']);
// } elseif (isset($_POST['add_player'])) {
//     $gameController->addPlayer($_POST['email'], $_POST['nickname']);
// } elseif (isset($_POST['add_contest'])) {
//     $gameController->addContest($_POST['game_id'], $_POST['start_date'], $_POST['winner_id']);
// } elseif (isset($_GET['idPlayer'])) {
//     $gameController->deletePlayerById($_GET['idPlayer']);
// } else {
    // Utilisation du routage (exemple simplifié) :
    // $action = $_GET['action'] ?? 'listGames';

    // switch ($action) {
    //     case 'deleteGame':
    //         $gameController->deleteGameById($_GET['id']);
    //         break;
        // Ajoutez d'autres cas pour d'autres actions...
//         default:
//             $gameController->list();
//             break;
//     }
// }