<?php

namespace Model\Repository;

use PDOException;
use Service\Session;
use Model\Entity\Detail;

class DetailRepository extends BaseRepository
{
    public function insertDetail(Detail $detail)
    {
        try {
            $this->dbConnection->beginTransaction();

            $sql = "INSERT INTO `detail` (room_id, booking_id, booking_start_date, booking_end_date) VALUES (:room_id, :booking_id, :booking_start_date, :booking_end_date)";

            $request = $this->dbConnection->prepare($sql);
            
            $request->bindValue(":room_id", $detail->getRoom_id());
            $request->bindValue(":booking_id", $detail->getBooking_id());
            $request->bindValue(":booking_start_date", $detail->getBooking_start_date());
            $request->bindValue(":booking_end_date", $detail->getBooking_end_date());

            $request = $request->execute();
            
            // Validez la transaction si tout s'est bien passé
            $this->dbConnection->commit();

         } catch (\PDOException $e) {
            // En cas d'erreur, annulez la transaction

            $this->dbConnection->rollBack();
            echo "Erreur : " . $e->getMessage();
        }
    }

    public function addDetail(Detail $detail)
    {
        $sql = "INSERT INTO detail (room_id, booking_id, booking_start_date, booking_end_date) VALUES (:room_id, :booking_id, :booking_start_date, :booking_end_date";

        // Utilisation d'un bloc try-catch pour gérer les exceptions PDO
        try {
            $request = $this->dbConnection->prepare($sql);

            // Utilisation de bindValue pour lier les valeurs
            $request->bindValue(":room_id", $detail->getRoom_id());

            $request->bindValue(":booking_id", $detail->getBooking_id());
            $request->bindValue(":booking_start_date", $detail->getBooking_start_date());
            $request->bindValue(":booking_end_date", $detail->getBooking_end_date());

            // Exécute la requête
            $request->execute();

            // Utilisation de rowCount pour vérifier le nombre de lignes affectées
            if ($request->rowCount() > 0) {
                // Retourne true si la requête a réussi
                return true;
            } else {
                // Retourne false si aucune ligne n'a été affectée
                return false;
            }
        } catch (PDOException $e) {
            // Gestion des exceptions PDO
            error_log("PDOException in addBookings: " . $e->getMessage());
            return false;
        }
    }

    public function deleteDetail($id){
        
        $request = $this->dbConnection->prepare("DELETE FROM detail WHERE id_detail = :id_detail");
        $request->bindParam(':id_detail',$id);

        if($request->execute()) {

            return true; 
            // La suppression a réussi
            } else {
            return false; 
            // La suppression a échoué
        }
    }



    public function findDetailById($id)
    {
        $request = $this->dbConnection->prepare("SELECT * FROM detail WHERE room_id = :room_id");
        $request->bindParam(':room_id',$id);

        if($request->execute()) {
            if ($request->rowCount() == 1) {
                $class = "Model\Entity\\" . ucfirst('detail');
                $request->setFetchMode(\PDO::FETCH_CLASS, $class);
                return $request->fetch();
            }
        }
    }

    public function getRoomPriceById($id)
    {
        $request = $this->dbConnection->prepare("SELECT price FROM rooms WHERE id_room = :id_room");
        $request->bindParam(':id_room',$id);

        if($request->execute()) {
            $result = $request->fetchColumn();
            return $result !== false ? $result : null;
        } else {
            return null;
            
        }
    }

}