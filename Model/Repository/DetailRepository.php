<?php

namespace Model\Repository;

use PDOException;
use Service\Session;
use Model\Entity\Detail;

class DetailRepository extends BaseRepository
{
    // public function insertDetail($room_id, $booking_id, $booking_start_date,$booking_end_date)
    // {
    //     $detail = new Detail;
    //     $detail->setRoom_id($room_id)
    //         ->setBooking_id($booking_id)
    //         ->setBooking_start_date($booking_start_date)
    //         ->setBooking_end_date($booking_end_date);
        
    //     try {
    //         $this->dbConnection->beginTransaction();

    //         $sql = "INSERT INTO `detail` (room_id, booking_id, booking_start_date, booking_end_date) VALUES (:room_id, :booking_id, :booking_start_date, :booking_end_date, NOW())";

    //         $request = $this->dbConnection->prepare($sql);
            
    //         $request->bindValue(":room_id", $room_id);
    //         $request->bindValue(":booking_id", $booking_id);
    //         $request->bindValue(":booking_start_date", $booking_start_date);
    //         $request->bindValue(":booking_end_date", $booking_end_date);

    //         $request = $request->execute();
            
    //         // Validez la transaction si tout s'est bien passé
    //         $this->dbConnection->commit();

    //      } catch (\PDOException $e) {
    //         // En cas d'erreur, annulez la transaction

    //         $this->dbConnection->rollBack();
    //         echo "Erreur : " . $e->getMessage();
    //     }
    // }

    // public function addDetail(Detail $detail)
    // {
    //     $sql = "INSERT INTO detail (room_id, booking_id, booking_start_date, booking_end_date) VALUES (:room_id, :booking_id, :booking_start_date, :booking_end_date";

        // Utilisation d'un bloc try-catch pour gérer les exceptions PDO
        // try {
        //     $request = $this->dbConnection->prepare($sql);

            // Utilisation de bindValue pour lier les valeurs
            // $request->bindValue(":room_id", $detail->getRoom_id());

            // $request->bindValue(":booking_id", $detail->getBooking_id());
            // $request->bindValue(":booking_start_date", $detail->getBooking_start_date());
            // $request->bindValue(":booking_end_date", $detail->getBooking_end_date());

            // Exécute la requête
            // $request->execute();

            // Utilisation de rowCount pour vérifier le nombre de lignes affectées
            // if ($request->rowCount() > 0) {
                // Retourne true si la requête a réussi
            //     return true;
            // } else {
                // Retourne false si aucune ligne n'a été affectée
                // return false;
        //     }
        // } catch (PDOException $e) {
            // Gestion des exceptions PDO
    //         error_log("PDOException in addBookings: " . $e->getMessage());
    //         return false;
    //     }
    // }

    // public function deleteDetail($id){
        
    //     $request = $this->dbConnection->prepare("DELETE FROM detail WHERE id_detail = :id_detail");
    //     $request->bindParam(':id_detail',$id);

    //     if($request->execute()) {

            // return true; 
            // La suppression a réussi
            // } else {
            // return false; 
            // La suppression a échoué
      



    // public function findDetailById($id)
    // {
    //     $request = $this->dbConnection->prepare("SELECT * FROM detail WHERE room_id = :room_id");
    //     $request->bindParam(':room_id',$id);

    //     if($request->execute()) {
    //         if ($request->rowCount() == 1) {
    //             $class = "Model\Entity\\" . ucfirst('detail');
    //             $request->setFetchMode(\PDO::FETCH_CLASS, $class);
    //             return $request->fetch();
    //         }
    //     }
    // }

    // public function updateOrder(Order $order)
    // {
    //     $sql = "UPDATE order 
    //             SET state = :state, user_id = :userId
    //             WHERE id = :id";
    //     $request = $this->dbConnection->prepare($sql);
    //     $request->bindValue(":id", $order->getId());
    //     $request->bindValue(":state", $order->getState());
    //     $request->bindValue(":userId", $order->getUserId());
    //     $request = $request->execute();
    //     if ($request) {
    //         if ($request == 1) {
    //             Session::addMessage("success",  "La mise à jour de la commande a bien été éffectuée");
    //             return true;
    //         }
    //         Session::addMessage("danger",  "Erreur : la commande n'a pas été mise à jour");
    //         return false;
    //     }
    //     Session::addMessage("danger",  "Erreur SQL");
    //     return null;
    // }

}