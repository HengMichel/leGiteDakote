<?php

namespace Model\Repository;

use PDOException;
use Model\Entity\Details;

class DetailsRepository extends BaseRepository
{
    public function insertDetail(Details $details)
    {
        try 
        {
            $this->dbConnection->beginTransaction();
            $sql = "INSERT INTO `details` (room_id, booking_id, booking_start_date, booking_end_date) VALUES (:room_id, :booking_id, :booking_start_date, :booking_end_date)";
            $request = $this->dbConnection->prepare($sql);
            $request->bindValue(":room_id", $details->getRoom_id());
            $request->bindValue(":booking_id", $details->getBooking_id());
            $request->bindValue(":booking_start_date", $details->getBooking_start_date());
            $request->bindValue(":booking_end_date", $details->getBooking_end_date());
            $success = $request->execute();
            // Valide la transaction si tout s'est bien passé
            $this->dbConnection->commit();
            return $success;
         } 
         catch (\PDOException $e) 
         {
            // En cas d'erreur, annulez la transaction
            $this->dbConnection->rollBack();
            echo "Erreur : " . $e->getMessage();
            // Indique un échec d'insertion
            return false; 
        }
    }
    // ok
    // public function selectDetail($id_detail)
    // {
    //     try 
    //     {
    //         $this->dbConnection->beginTransaction();
    //         $sql = "SELECT * FROM `details` WHERE `id_detail` = :id_detail";
    //         $request = $this->dbConnection->prepare($sql);
    //         $request->bindValue(":id_detail", $id_detail);
    //         $request = $request->execute();           
    //         // Valide la transaction si tout s'est bien passé
    //         $this->dbConnection->commit();

    //      } catch (\PDOException $e) 
    //      {
    //         // En cas d'erreur, annule la transaction
    //         $this->dbConnection->rollBack();
    //         echo "Erreur : " . $e->getMessage();
    //         return null;
    //     }
    // }

    // public function addDetail($bookingId)
    // {
    //     // Utilisation d'un bloc try-catch pour gérer les exceptions PDO
    //     try 
    //     {
    //     // En résumé, cette requête récupère l'ID de la réservation et l'ID de la chambre associés à une réservation spécifique à partir de la table details, en reliant les tables details, bookings et rooms à l'aide de jointures internes.
    //         $sql = "SELECT d.booking_id, r.room_id FROM details d 
    //             INNER JOIN bookings b ON d.booking_id = b.id_booking
    //             INNER JOIN rooms r ON d.room_id = r.id_room
    //             WHERE d.booking_id = :booking_id";
    //         $request = $this->dbConnection->prepare($sql);
    //         $request->bindValue(":booking_id", $bookingId, \PDO::PARAM_INT);
    //         // d_die($request);
    //         $request->execute();
    //         return $request->fetch(\PDO::FETCH_ASSOC);

    //     } catch (PDOException $e) 
    //     {
    //         error_log("PDOException in getBookingAndRoomIdsByBookingId: " . $e->getMessage());
    //         return null;
    //     }
    // }

    public function findDetailById($id)
    {
        $request = $this->dbConnection->prepare("SELECT * FROM details WHERE room_id = :room_id");
        $request->bindParam(':room_id',$id);
        if($request->execute()) 
        {
            if ($request->rowCount() == 1) 
            {
                $class = "Model\Entity\\" . ucfirst('details');
                // utilise le bon mode de récupération selon la configuration
                $request->setFetchMode(\PDO::FETCH_CLASS, $class);
                return $request->fetch();
            }
        }
    }
    // ok

    // public function deleteDetail($id)
    // {
    //     $request = $this->dbConnection->prepare("DELETE FROM details WHERE id_detail = :id_detail");
    //     $request->bindParam(':id_detail',$id);
    //     if($request->execute()) 
    //     {
    //         // La suppression a réussi
    //         return true; 
    //     } else 
    //     {
    //         // La suppression a échoué
    //         return false; 
    //     }
    // }

    // public function updateDetailsByRoomId($id)
    // {
    //     // d_die($id);
    //     try 
    //     {
    //         $request = $this->dbConnection->prepare("UPDATE details SET room_id = :room_id WHERE room_id = :id_room");
    //         // Mise à jour de la colonne "room_id" dans la table "details" où "room_id" correspond à l'identifiant de la chambre
    
    //         $request->bindParam(':room_id', $id);
    //         $request->bindParam(':id_room', $id); // Utilisé pour filtrer les enregistrements à mettre à jour
    
    //         if ($request->execute()) 
    //         {
    //             // La mise à jour a réussi
    //             return true; 
    //         } else 
    //         {
    //             // La mise à jour a échoué
    //             return false; 
    //         }
    //     } catch (PDOException $e) 
    //     {
    //         // Gère les erreurs, par exemple :
    //         echo "Erreur : " . $e->getMessage();
    //         return false; // La mise à jour a échoué
    //     }
    // }

    // public function deleteDetailsByRoomId($id)
    // {
    //     $request = $this->dbConnection->prepare("DELETE FROM details WHERE room_id = :room_id");
    //     $request->bindParam(':room_id',$id);
    //     if($request->execute()) 
    //     {
    //         // La suppression a réussi
    //         return true; 
    //     } else 
    //     {
    //         // La suppression a échoué
    //         return false; 
    //     }
    // }

    public function findDetailByBookingId($id)
    {
        $request = $this->dbConnection->prepare("SELECT * FROM details WHERE booking_id = :booking_id");
        $request->bindParam(':booking_id', $id , \PDO::PARAM_INT);
        $request->execute();
        return $request->fetch();
    }
    // ok

    // public function findDetailBookingPriceById($id)
    // {
    //     // d_die($id);
    //     $request = $this->dbConnection->prepare("
    //     SELECT d.*, b.booking_price 
    //     FROM details d 
    //     JOIN bookings b ON d.booking_id = b.id_booking 
    //     WHERE d.id_detail = :id_detail");
    //     $request->bindParam(':id_detail', $id, \PDO::PARAM_INT);
    //     // d_die($id);
    //     if($request->execute()) 
    //     {
    //         if ($request->rowCount() == 1) 
    //         {
    //             $class = "Model\Entity\\" . ucfirst('details');
    //             $request->setFetchMode(\PDO::FETCH_CLASS, $class);
    //             // d_die($request->fetch());
    //             return $request->fetch();
    //         }
    //     }
    // }

    // public function getRoomPriceById($id)
    // {
    //     $request = $this->dbConnection->prepare("SELECT price FROM rooms WHERE id_room = :id_room");
    //     $request->bindParam(':id_room',$id);
    //     if($request->execute()) 
    //     {
    //         $result = $request->fetchColumn();
    //         return $result !== false ? $result : null;
    //     } else 
    //     {
    //         return null;
    //     }
    // }
}