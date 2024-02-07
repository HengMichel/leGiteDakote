<?php

namespace Model\Repository;

use Exception;
use PDOException;
use Service\Session;
use Model\Entity\Bookings;

class BookingsRepository extends BaseRepository
{
    public function addBookings(Bookings $bookings)
    {
        $sql = "INSERT INTO bookings (booking_start_date, booking_end_date, user_id, room_id, booking_price, booking_state) VALUES (:booking_start_date, :booking_end_date, :user_id, :room_id, :booking_price, :booking_state)";

        // Utilisation d'un bloc try-catch pour gérer les exceptions PDO
        try {
            $request = $this->dbConnection->prepare($sql);

            // Utilisation de bindValue pour lier les valeurs
            $request->bindValue(":booking_start_date", $bookings->getBooking_start_date());
            $request->bindValue(":booking_end_date", $bookings->getBooking_end_date());
            $request->bindValue(":user_id", $bookings->getUser_id());
            $request->bindValue(":room_id", $bookings->getRoom_id());
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


    public function cancelBooking($id){
        
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

    public function findBookingById($id){

        try {
              $sql = "SELECT * FROM bookings WHERE id_booking = :id";
              $request = $this->dbConnection->prepare($sql);
              $request->bindValue(":id", $id);
              $request->execute();
      
              return $request->fetch(\PDO::FETCH_ASSOC);

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
                // utilise le bon mode de récupération selon votre configuration
                $request->setFetchMode(\PDO::FETCH_CLASS, $class);
                return $request->fetch();
            }
        }
    }

   // prépare la requête pour vérifier si la chambre est dispo entre la date de départ et la date de fin
    public function findBookings(Bookings $bookings)
    {

        $sql = "SELECT * FROM bookings WHERE room_id = ? AND ((booking_start_date <= ? AND booking_end_date >= ?) OR (booking_start_date <= ? AND booking_end_date >= ?))";
        
        $request = $this->dbConnection->prepare($sql);
        
        $request->bindValue(1, $bookings->getRoom_id());
        $request->bindValue(2, $bookings->getBooking_start_date());
        $request->bindValue(3, $bookings->getBooking_end_date());
        $request->bindValue(4, $bookings->getBooking_start_date());
        $request->bindValue(5, $bookings->getBooking_end_date());
        
        $request->execute();
        
        return $request->fetchAll(\PDO::FETCH_ASSOC);
    }


    public function populateBookingsEntity(Bookings $bookings, array $data)
    {
        $bookings->setRoom_id($data['room_id']);
        $bookings->setBooking_price($data['booking_price']);
        $bookings->setBooking_start_date($data['booking_start_date']);
        $bookings->setBooking_end_date($data['booking_end_date']);
    }


    public function findTableRooms(Bookings $bookings){

        $sql= "SELECT 
        b.`id_booking`,
        b.`booking_start_date`,
        b.`booking_end_date`,
        b.`user_id`,
        b.`room_id`,
        b.`booking_price`,
        b.`booking_state`,
        r.`id_room`,
        r.`room_number`,
        r.`price`,
        r.`room_imgs`,
        r.`persons`,
        r.`category`,
        r.`room_state`
    FROM 
        `bookings` AS b
    JOIN 
        `rooms` AS r ON b.`room_id` = r.`id_room`
    WHERE 
        r.`room_imgs` IS NOT NULL
        AND r.`room_imgs` != '' 
        AND b.`room_id` = :room_id";

    $request = $this->dbConnection->prepare($sql);

    // S'assurer de lier la valeur pour :room_id; 
    $request->bindValue(":room_id", $bookings->getRoom_id(), \PDO::PARAM_INT);  

    // Récupère les résultats
    $results = $request->fetchAll(\PDO::FETCH_ASSOC);

    // Exécute la requête avant de récupérer les résultats
    $request->execute();  

    // Traite les résultats comme nécessaire
    return $results;
    }


    public function findUserBookings($userId)
    {
    $request = $this->dbConnection->prepare("SELECT * FROM bookings WHERE user_id = :user_id");
    $request->bindParam(":user_id", $userId, \PDO::PARAM_INT);
    // Affiche le requête SQL pour le débogage
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
