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

    public function addDetail($bookingId)
    {
        // Utilisation d'un bloc try-catch pour gérer les exceptions PDO
        try {
// En résumé, cette requête récupère l'ID de la réservation et l'ID de la chambre associés à une réservation spécifique à partir de la table detail, en reliant les tables detail, bookings et rooms à l'aide de jointures internes.
            $sql = "SELECT d.booking_id, r.room_id FROM detail d 
                INNER JOIN bookings b ON d.booking_id = b.id_booking
                INNER JOIN rooms r ON d.room_id = r.id_room
                WHERE d.booking_id = :booking_id";
            $request = $this->dbConnection->prepare($sql);
            $request->bindValue(":booking_id", $bookingId, \PDO::PARAM_INT);
    // d_die($request);
            $request->execute();
            return $request->fetch(\PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("PDOException in getBookingAndRoomIdsByBookingId: " . $e->getMessage());
            return null;
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