<?php

namespace Model\Repository;

use Model\Entity\Bookings;
use Service\Session;

class BookingsRepository extends BaseRepository
{
    public function addBookings(Bookings $bookings)
    {
        $sql = "INSERT INTO bookings (booking_start_date, booking_end_date, user_id, room_id, booking_price,booking_state) VALUES (:booking_start_date, :booking_end_date, :user_id, :room_id, :booking_price,:booking_state)";
        $request = $this->dbConnection->prepare($sql);
        $request->bindValue(":booking_start_date", $bookings->getBooking_start_date());
        $request->bindValue(":booking_end_date", $bookings->getBooking_end_date());
        $request->bindValue(":user_id", $bookings->getUser_id());
        $request->bindValue(":room_id", $bookings->getRoom_id());
        $request->bindValue(":booking_price", $bookings->getBooking_price());
        $request->bindValue(":booking_state", $bookings->getBooking_state());
        $request->execute();
        if ($request) {
            if ($request == 1) {
                Session::addMessage("success",  "Réservation réussie!");
                return true;
            }
            Session::addMessage("danger",  "Erreur : la Réservation n'a pas été enregisté");
            return false;
        }
        Session::addMessage("danger",  "Erreur SQL");
        return null;
    }

    // Trouver toutes les réservations pour une chambre spécifique et une période donnée
    public function findAllBookings(Bookings $bookings)
    {
    $sql = "SELECT * FROM bookings WHERE room_id = ? AND ((booking_start_date <= ? AND booking_end_date >= ?) OR (booking_start_date <= ? AND booking_end_date >= ?))";

    $request = $this->dbConnection->prepare($sql);

    $request->bindValue(":room_id", $bookings->getRoom_id());
    $request->bindValue(":booking_start_date", $bookings->getBooking_start_date());
    $request->bindValue(":booking_end_date", $bookings->getBooking_end_date());
    $request->bindValue(":booking_end_date", $bookings->getBooking_end_date());
    $request->bindValue(":booking_start_date", $bookings->getBooking_start_date());
    
    $request->execute();

    return $request->fetchAll(\PDO::FETCH_ASSOC);



        //************* */ version chatgpt  *****************

    // $sql = "SELECT * FROM bookings WHERE room_id = ? AND ((booking_start_date <= ? AND booking_end_date >= ?) OR (booking_start_date <= ? AND booking_end_date >= ?))";

    // $request = $this->dbConnection->prepare($sql);

    // $request->bindValue(1, $bookings->getRoom_id());
    // $request->bindValue(2, $bookings->getBooking_start_date());
    // $request->bindValue(3, $bookings->getBooking_end_date());
    // $request->bindValue(4, $bookings->getBooking_start_date());
    // $request->bindValue(5, $bookings->getBooking_end_date());

    // $request->execute();

    // return $request->fetchAll(\PDO::FETCH_ASSOC);
    }

    

    public function deleteContestById($id)
    {
        $request = $this->dbConnection->prepare("DELETE FROM contest WHERE id_contest = :id_contest");
        $request->bindParam(':id_contest', $id);

        if ($request->execute()) {
            if ($request->rowCount() == 1) {
                Session::addMessage("success", "Le joueur a été supprimé avec succès");
                return true;
            } else {
                Session::addMessage("danger", "Aucun joueur n'a été supprimé");
                return false;
            }
        } else {
            Session::addMessage("danger", "Erreur lors de la suppression du joueur");
            return false;
        }
    }


}
