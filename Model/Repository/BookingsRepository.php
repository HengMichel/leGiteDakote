<?php

namespace Model\Repository;

use PDOException;
use Model\Entity\Bookings;

class BookingsRepository extends BaseRepository
{
    public function addBookings(Bookings $bookings)
    {
        // d_die($bookings);
        $sql = "INSERT INTO bookings (user_id, booking_price, booking_state) VALUES ( :user_id, :booking_price, :booking_state)";
        // Utilisation d'un bloc try-catch pour gérer les exceptions PDO
        try 
        {
            $request = $this->dbConnection->prepare($sql);
            // Utilisation de bindValue pour lier les valeurs
            $request->bindValue(":user_id", $bookings->getUser_id(), \PDO::PARAM_INT);
            $request->bindValue(":booking_price", $bookings->getBooking_price());
            $request->bindValue(":booking_state", $bookings->getBooking_state());
            // Exécute la requête
            $request->execute();
            // Retourne l'ID de la réservation nouvellement créée
            return $this->dbConnection->lastInsertId();

        } catch (PDOException $e) 
        {
            // Gestion des exceptions PDO
            error_log("PDOException in addBookings: " . $e->getMessage());
            return false;
        }
    }

// préparation de la requête pour vérifier si la chambre est dispo entre la date de départ et la date de fin
    public function findBookings(Bookings $bookings)
    {
        $sql = "SELECT * FROM bookings WHERE id_booking = :id_booking";
        $request = $this->dbConnection->prepare($sql);
        $request->bindValue(":id_booking",$bookings);
        $request->execute();
        return $request->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function findUserBookings($id)
    {
        debug($id);
        $request = $this->dbConnection->prepare("SELECT * FROM bookings WHERE user_id = :user_id");
        $request->bindParam(":user_id", $id, \PDO::PARAM_INT);
        // Affiche la requête SQL pour le débogage
        // var_dump($request->queryString);
        if ($request->execute()) 
        {
            // Utilise fetchObject pour récupérer un objet de la classe Bookings
            $results = $request->fetchObject("Model\Entity\Bookings");
            // var_dump($results);
            return $results;
        } else 
        {
            return null;
        }
    }
    
    // #########  Ne pas utiliser cette methode car il est préférable de conserver les données utilisateur ###############  
    // public function deleteBookingsById($id)
    // {
    //     $request = $this->dbConnection->prepare("DELETE FROM bookings WHERE id_booking = :id_booking");
    //     $request->bindParam(':id_booking',$id);
    //     if($request->execute()) 
    //     {
    //         // La suppression a réussi
    //         return true; 
    //     } else {
    //         // La suppression a échoué
    //         return false; 
    //     }
    // }  
//  ########################################################################################
}
