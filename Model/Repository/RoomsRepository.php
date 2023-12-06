<?php

namespace Model\Repository;

use Model\Entity\Rooms;
use Service\Session;

class RoomsRepository extends BaseRepository
{
    public function addRooms(Rooms $rooms)
    {
      
        $sql = "INSERT INTO rooms (room_number, price, room_imgs, persons, category) VALUES ( :room_number, :price, :room_imgs, :persons, :category)";
        $request = $this->dbConnection->prepare($sql);
        $request->bindValue(":room_number", $rooms->getRoom_number());
        $request->bindValue(":price", $rooms->getPrice());
        $request->bindValue(":room_imgs", $rooms->getRoom_imgs());
        $request->bindValue(":persons", $rooms->getPersons());
        $request->bindValue(":category", $rooms->getCategory());
       
        try {
            $result = $request->execute();
    
            if ($result) {
                Session::addMessage("success", "Le nouveau jeu a bien été enregistré");
                return true;
            } else {
                Session::addMessage("danger", "Erreur : le jeu n'a pas été enregistré");
                return false;
            }
        } catch (\PDOException $exception) {
            Session::addMessage("danger", "Erreur SQL : " . $exception->getMessage());
            return false;
        }
    }

    public function findAllRooms()
    {
        $request = $this->dbConnection->prepare("SELECT * FROM rooms");

        if ($request->execute()) {
            return $request->fetchAll(\PDO::FETCH_CLASS, "Model\Entity\Rooms");
            } else {
                return null;
        }
    }   

    public function findRoomsById($id)
    {
        $request = $this->dbConnection->prepare("SELECT * FROM rooms WHERE id = :id");
        $request->bindParam(':id', $id);
    
        if ($request->execute()) {
            return $request->fetch(\PDO::FETCH_CLASS, "Model\Entity\Rooms");
        } else {
            return null;
        }
    }

    public function deleteRoomsById($id)
    {
    $request = $this->dbConnection->prepare("DELETE FROM rooms WHERE id_rooms = :id_rooms");
    $request->bindParam(':id_rooms', $id);

    if ($request->execute()) {
        return true; 
        // La suppression a réussi
        } else {
        return false; 
        // La suppression a échoué
        }
    }


}
