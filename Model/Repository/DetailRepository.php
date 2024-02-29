<?php

namespace Model\Repository;

use Model\Entity\Detail;
use Service\Session;

class DetailRepository extends BaseRepository
{
    public function insertDetail($room_id, $booking_id, $booking_start_date,$booking_end_date)
    {
        $detail = new Detail;
        $detail->setRoom_id($room_id)
            ->setBooking_id($booking_id)
            ->setBooking_start_date($booking_start_date)
            ->setBooking_end_date($booking_end_date);
        
        try {
            $this->dbConnection->beginTransaction();

            $sql = "INSERT INTO `detail` (room_id, booking_id, booking_start_date, booking_end_date) VALUES (:room_id, :booking_id, :booking_start_date, :booking_end_date, NOW())";

            $request = $this->dbConnection->prepare($sql);
            
            $request->bindValue(":room_id", $room_id);
            $request->bindValue(":orderId", $booking_id);
            $request->bindValue(":booking_start_date", $booking_start_date);
            $request->bindValue(":booking_end_date", $booking_end_date);

            $request = $request->execute();
            
            // Validez la transaction si tout s'est bien passé
            $this->dbConnection->commit();

         } catch (\PDOException $e) {
            // En cas d'erreur, annulez la transaction

            $this->dbConnection->rollBack();
            echo "Erreur : " . $e->getMessage();
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