<?php

namespace Model\Repository;

use Model\Entity\Rooms;
use Service\Session;

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
}