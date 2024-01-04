<?php

namespace Model\Repository;

class RoomsRepository extends BaseRepository
{
    public function findAllRooms()
    {
        $request = $this->dbConnection->prepare("SELECT * FROM rooms");

        if ($request->execute()) {
            return $request->fetchAll(\PDO::FETCH_CLASS, "Model\Entity\Rooms");
            } else {
                return null;
        }
    }   

    public function getPrice($id_room)
    {
        $request = $this->dbConnection->prepare("SELECT price FROM rooms WHERE id_room = :id_room");
        $request->bindValue(":id_room", $id_room);

        if ($request->execute()) {
            // Retourne le prix en tant que résultat de la requête
            return $request->fetchColumn();
        } else {
            return null;
        }
    }   
}