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

    public function updateDetailsByRoomId($id)
    {
        // d_die($id);
        try 
        {
            $request = $this->dbConnection->prepare("UPDATE details SET room_id = :room_id WHERE room_id = :id_room");
            // Mise à jour de la colonne "room_id" dans la table "details" où "room_id" correspond à l'identifiant de la chambre
    
            $request->bindParam(':room_id', $id);
            // Utilisé pour filtrer les enregistrements à mettre à jour
            $request->bindParam(':id_room', $id); 
    
            if ($request->execute()) 
            {
                // La mise à jour a réussi
                return true; 
            } else 
            {
                // La mise à jour a échoué
                return false; 
            }
        } catch (PDOException $e) 
        {
            // Gère les erreurs, par exemple :
            echo "Erreur : " . $e->getMessage();
            return false; // La mise à jour a échoué
        }
    }

    public function deleteDetailsByRoomId($id)
    {
        $request = $this->dbConnection->prepare("DELETE FROM details WHERE room_id = :room_id");
        $request->bindParam(':room_id',$id);
        if($request->execute()) 
        {
            // La suppression a réussi
            return true; 
        } else 
        {
            // La suppression a échoué
            return false; 
        }
    }

    // Méthode pour convertir un tableau en objet ici pour Details
    public function arrayToDetails(array $data): Details
    {
        $details = new Details();
        $details->setId_detail($data['id_detail']);
        $details->setRoom_id($data['room_id']);
        $details->setBooking_id($data['booking_id']);
        $details->setBooking_start_date($data['booking_start_date']);
        $details->setBooking_end_date($data['booking_end_date']);
        return $details;
    }

    // public function findDetailByBookingId($id)
    // {
// PROBleme ici id = room_id
        // debug($id);
        // $request = $this->dbConnection->prepare("SELECT * FROM details WHERE booking_id = :booking_id");
        // $request->bindParam(':booking_id', $id , \PDO::PARAM_INT);
        // $request->execute();
        // debug($request);
    //     $data = $request->fetch(\PDO::FETCH_ASSOC);
    //     return $data ? $this->arrayToDetails($data) : null;
    // }
    public function findDetailByBookingId($bookingId)
    {
        $sql = "SELECT * FROM details WHERE booking_id = :booking_id";
        $request = $this->dbConnection->prepare($sql);
        $request->bindParam(":booking_id", $bookingId, \PDO::PARAM_INT);
        $request->execute();
        return $request->fetchObject("Model\Entity\Details");
    }

    public function findDetailByRoomId($id)
    {
        // debug($id);
        $request = $this->dbConnection->prepare("SELECT * FROM details WHERE room_id = :room_id");
        $request->bindParam(':room_id', $id , \PDO::PARAM_INT);
        $request->execute();
        return $request->fetch(\PDO::FETCH_ASSOC);
    }

    public function findDetail(Details $details)
    {
        $sql = "SELECT * FROM details WHERE id_detail = :id_detail";
        $request = $this->dbConnection->prepare($sql);
        $request->bindValue(":id_detail",$details);
        $request->execute();
        return $request->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function findDetailByRoomAndDate($attributes = [])
    {
        if (!is_array($attributes)) 
        {
            // Retourne false si le tableau d'attributs est vide ou incorrect.
            return false; 
        }
    
        $sql = "SELECT * FROM details WHERE room_id = :room_id AND 
                (booking_start_date <= :booking_end_date AND booking_end_date >= :booking_start_date)";
    
        $request = $this->dbConnection->prepare($sql);
        $request->bindValue(":room_id", $attributes['room_id'], \PDO::PARAM_INT);
        $request->bindValue(":booking_start_date", $attributes['booking_start_date'], \PDO::PARAM_STR);
        $request->bindValue(":booking_end_date", $attributes['booking_end_date'], \PDO::PARAM_STR);
    
        try
        {
            $request->execute();
            return $request->fetchAll(\PDO::FETCH_ASSOC);
        }
        catch (\PDOException $exception)
        {
            echo "Erreur la chambre n'est pas disponible à ces dates : " . $exception->getMessage();
            return false;
        }
    } 
}