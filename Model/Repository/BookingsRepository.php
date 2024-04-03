<?php

namespace Model\Repository;

use Exception;
use PDOException;
use Service\Session;
use Model\Entity\Detail;
use Model\Entity\Bookings;

class BookingsRepository extends BaseRepository
{
    public function addBookings(Bookings $bookings)
    {
        // d_die($bookings);

        $sql = "INSERT INTO bookings (user_id, booking_price, booking_state) VALUES ( :user_id, :booking_price, :booking_state)";

        // Utilisation d'un bloc try-catch pour gérer les exceptions PDO
        try {
            $request = $this->dbConnection->prepare($sql);

            // Utilisation de bindValue pour lier les valeurs
            $request->bindValue(":user_id", $bookings->getUser_id());
            $request->bindValue(":booking_price", $bookings->getBooking_price());
            $request->bindValue(":booking_state", $bookings->getBooking_state());

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

    public function cancelBooking($id)
    {
        
        try {
// Avant la recherche de la réservation
// echo "ID de réservation à annuler : " . $id;

            // Récupérer la réservation par son ID
            $booking = $this->findBookingById($id);

            // echo "Avant la mise à jour : ";
            // print_r($booking);

            // Vérifie si la réservation existe
            if ($booking) {
                // Mets à jour l'état de la réservation
                $sql = "UPDATE bookings SET booking_state = :booking_state WHERE id_booking = :id_booking";
                $request = $this->dbConnection->prepare($sql);
                $request->bindValue(":booking_state", "cancel");
                $request->bindValue(":id_booking", $id);

                $success = $request->execute();
    
                if ($success) {
                // echo "Après la mise à jour : " . $id;
                    
                    Session::addMessage("success",  "L'annulation de la réservation a bien été effectuée");
                    return true;
                } else {
                    Session::addMessage("danger",  "Erreur : la réservation n'a pas été mise à jour");
                    return false;
                }
            } else {
                // La réservation n'a pas été trouvée
                Session::addMessage("danger",  "Erreur : réservation introuvable");
                return false;
            }    
        } catch (PDOException $e) {
            // log l'erreur ici
            throw new Exception("Erreur lors de l'annulation de la réservation : " . $e->getMessage());
        }
    }

// #########  Ne pas utiliser cette methode car il est préférable de conserver les données utilisateur ###############  

    // public function deleteBookingsById($id){

    //     $request = $this->dbConnection->prepare("DELETE FROM bookings WHERE id_booking = :id_booking");
    //     $request->bindParam(':id_booking',$id);

    //     if($request->execute()) {

    //         return true; 
    //         // La suppression a réussi
    //         } else {
    //         return false; 
    //         // La suppression a échoué
    //         }
    //   }  

//  ###################################################################################################################

    public function findBookingsForRoom($id)
    {
        $request = $this->dbConnection->prepare("SELECT * FROM bookings WHERE room_id = :room_id");
        $request->bindParam(':room_id', $id);
    
        if ($request->execute()) {
            $results = $request->fetchAll(\PDO::FETCH_CLASS, "Model\Entity\Bookings");
            return $results;
        } else {
            return null;
        }
    }



    
    public function findBookingById($id){
        // d_die($id);
        try {
            $sql = "SELECT * FROM bookings WHERE id_booking = :id_booking";
            $request = $this->dbConnection->prepare($sql);
            $request->bindValue(":id_booking", $id, \PDO::PARAM_INT);
            $request->execute(); // Exécutez la requête ici
    // d_die($request);
            // Récupérez les résultats après l'exécution de la requête
            $bookingData = $request->fetch(\PDO::FETCH_ASSOC);
            // d_die($bookingData); 
            // Utilisez ce débogage si nécessaire
    
            return $bookingData;
        } catch (PDOException $e) {
            // Gérer l'erreur
            throw new Exception("Erreur lors de la recherche de la réservation par ID : " . $e->getMessage());
        } 
    }
    
    





    public function findBookingsRoomsById($id)
    {
        $request = $this->dbConnection->prepare("SELECT * FROM bookings WHERE room_id = :room_id");
        $request->bindParam(':room_id',$id);

        if($request->execute()) {
            if ($request->rowCount() == 1) {
                $class = "Model\Entity\\" . ucfirst('bookings');
                $request->setFetchMode(\PDO::FETCH_CLASS, $class);
                return $request->fetch();
            }
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

    public function findBookingsForDetail(Detail $detail)
    {

        $sql = "SELECT * FROM bookings WHERE id_booking = :id_booking";
        
        $request = $this->dbConnection->prepare($sql);
        $request->bindValue(":id_booking",$detail->getBooking_id());
        $request->execute();
        return $request->fetchAll(\PDO::FETCH_ASSOC);
    }


    public function getRoomIdByBookingId($bookingId)
{
    try {
        $sql = "SELECT room_id FROM detail WHERE booking_id = :booking_id";
        $request = $this->dbConnection->prepare($sql);
        $request->bindValue(":booking_id", $bookingId);
        $request->execute();

        // Utilisez fetchColumn pour récupérer la première colonne de la première ligne du résultat de la requête
        $roomId = $request->fetchColumn();

        // Retourne l'ID de la chambre associée à la réservation
        return $roomId !== false ? $roomId : null;
    } catch (PDOException $e) {
        // Gérer l'exception
        error_log("PDOException in getRoomIdByBookingId: " . $e->getMessage());
        return null;
    }
}



    public function findUserBookings($userId)
    {
    $request = $this->dbConnection->prepare("SELECT * FROM bookings WHERE user_id = :user_id");
    $request->bindParam(":user_id", $userId, \PDO::PARAM_INT);
    // Affiche la requête SQL pour le débogage
    // var_dump($request->queryString);

    if ($request->execute()) {
        $results = $request->fetchAll(\PDO::FETCH_CLASS, "Model\Entity\Bookings");
        // Affiche les résultats pour le débogage
        //   var_dump($results);
        return $results;

    } else {
        return null;
        }
    }
}
