<?php

namespace Model\Repository;

use Model\Entity\Player;
use Service\Session;

class PlayerRepository extends BaseRepository
{
    public function addPlayer(Player $player)
    {
        $sql = "INSERT INTO player (email, nickname) VALUES (:email,:nickname)";
        $request = $this->dbConnection->prepare($sql);
        $request->bindValue(":email", $player->getEmail());
        $request->bindValue(":nickname", $player->getNickname()); 
        $request = $request->execute();
        if ($request) {
            if ($request == 1) {
                Session::addMessage("success",  "Le nouvel utilisateur a bien été enregistré");
                return true;
            }
            Session::addMessage("danger",  "Erreur : l'utilisateur n'a pas été enregisté");
            return false;
        }
        Session::addMessage("danger",  "Erreur SQL");
        return null;
        }
    
    public function deletePlayerById($id)
    {
        $request = $this->dbConnection->prepare("DELETE FROM player WHERE id_player = :id_player");
        $request->bindParam(':id_player', $id);
    
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

    public function updatePlayer(Player $player)
    {
        $sql = "UPDATE player 
                         SET email = :email, nickname = :nickname
                         WHERE id_player = :id_player";
        $request = $this->dbConnection->prepare($sql);
        $request->bindValue(":email", $player->getEmail());
        $request->bindValue(":nickname", $player->getNickname());
        $request->bindValue(":id_player", $player->getId());
        $request = $request->execute();
        if ($request) {
            if ($request == 1) {
                Session::addMessage("success",  "La mise à jour de du joueur a bien été éffectuée");
                return true;
            }
            Session::addMessage("danger",  "Erreur : du joueur n'a pas été mise à jour");
            return false;
        }
        Session::addMessage("danger",  "Erreur SQL");
        return null;
    }
    
}
