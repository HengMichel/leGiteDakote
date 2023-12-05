<?php

namespace Model\Repository;

use Model\Entity\Contest;
use Service\Session;

class ContestRepository extends BaseRepository
{
    public function addContest(Contest $contest)
    {
        $sql = "INSERT INTO contest (game_id, start_date, winner_id) VALUES (:game_id, :start_date, :winner_id)";
        $request = $this->dbConnection->prepare($sql);
        $request->bindValue(":game_id", $contest->getGame_id());
        $request->bindValue(":start_date", $contest->getStart_date());
        $request->bindValue(":winner_id", $contest->getWinner_id());
        $request->execute();
        if ($request) {
            if ($request == 1) {
                Session::addMessage("success",  "Le nouveau jeu a bien été enregistré");
                return true;
            }
            Session::addMessage("danger",  "Erreur : le jeu n'a pas été enregisté");
            return false;
        }
        Session::addMessage("danger",  "Erreur SQL");
        return null;
    }

    public function findAllTables()
    {
        $sql = "SELECT c.*, g.*, p.*, COUNT(cp.player_id) AS nombre_de_joueurs  
        FROM contest c  
        LEFT JOIN player p ON c.winner_id = p.id_player  
        LEFT JOIN game g ON c.game_id = g.id_game  
        LEFT JOIN player_contest cp ON c.id_contest = cp.contest_id  
        GROUP BY c.id_contest, g.id_game  
        ORDER BY c.start_date DESC;";
    
        $request = $this->dbConnection->prepare($sql);
        $request->execute();
        return $request->fetchAll(\PDO::FETCH_ASSOC);
    }
    

    public function deleteContestById($id)
    {
        $request = $this->dbConnection->prepare("DELETE FROM contest WHERE id_contest = :id_contest");
        $request->bindParam(':id_contest', $id);

        if ($request->execute()) {
            if ($request->rowCount() == 1) {
                Session::addMessage("success", "Le joueur a été supprimé avec succès");
                return true;
            } else {
                Session::addMessage("danger", "Aucun joueur n'a été supprimé");
                return false;
            }
        } else {
            Session::addMessage("danger", "Erreur lors de la suppression du joueur");
            return false;
        }
    }


}
