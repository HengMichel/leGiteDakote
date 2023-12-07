<?php

namespace Controller;

use Model\Entity\Rooms;
use Service\Session;
use Model\Repository\BaseRepository;

class RoomsCrudController extends BaseRepository
{
    public function addRooms(Rooms $rooms)
{
    // Traitement de l'image
    $imgName = $_FILES["room_imgs"]["name"];
    $tmpName = $_FILES["room_imgs"]["tmp_name"];
    $destination = $_SERVER["DOCUMENT_ROOT"] . "/projetGite/assets/imgs/chambres/" . $imgName;

    // Valider et déplacer le fichier téléchargé
    if (move_uploaded_file($tmpName, $destination)) {
        // L'image a été téléchargée avec succès, procédez à l'insertion dans la base de données

        $sql = "INSERT INTO rooms (room_number, price, room_imgs, persons, category) VALUES (:room_number, :price, :room_imgs, :persons, :category)";
        $request = $this->dbConnection->prepare($sql);
        $request->bindValue(":room_number", $rooms->getRoom_number());
        $request->bindValue(":price", $rooms->getPrice());
        $request->bindValue(":room_imgs", $imgName); // Enregistrez le nom du fichier, pas le chemin complet
        $request->bindValue(":persons", $rooms->getPersons());
        $request->bindValue(":category", $rooms->getCategory());

        try {
            $result = $request->execute();

            if ($result) {
                Session::addMessage("success", "La nouvelle chambre a bien été enregistrée");
                return true;
            } else {
                Session::addMessage("danger", "Erreur : la chambre n'a pas été enregistrée");
                return false;
            }
        } catch (\PDOException $exception) {
            Session::addMessage("danger", "Erreur SQL : " . $exception->getMessage());
            return false;
        }
    } else {
        // Il y a eu un problème avec le téléchargement de l'image
        Session::addMessage("danger", "Erreur lors du téléchargement de l'image");
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
