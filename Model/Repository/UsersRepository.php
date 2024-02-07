<?php

namespace Model\Repository;

use Service\Session;
use Model\Entity\Users;

class UsersRepository extends BaseRepository
{
    public function addUsers(Users $users)

    {
        $sql = "INSERT INTO users (id_user, last_name, first_name, email, password, role, birthday, address, phone_number, gender) VALUES (:id_user, :last_name, :first_name, :email, :password, :role, :birthday, :address, :phone_number, :gender)";
        $request = $this->dbConnection->prepare($sql);
        $request->bindValue(":id_user", $users->getId_user());
        $request->bindValue(":last_name", $users->getLast_name()); 
        $request->bindValue(":first_name", $users->getFirst_name()); 
        $request->bindValue(":email", $users->getEmail()); 
        $request->bindValue(":password", $users->getPassword()); 
        $request->bindValue(":role", $users->getRole()); 
        $request->bindValue(":birthday", $users->getBirthday()); 
        $request->bindValue(":address", $users->getAddress()); 
        $request->bindValue(":phone_number", $users->getPhone_number()); 
        $request->bindValue(":gender", $users->getGender()); 
        $request = $request->execute();
        if ($request) {
            if ($request == 1) {
                return true;
            }
            return false;
        }
        return null;
    }

    public function findUsersById($id)
    {
        $request = $this->dbConnection->prepare("SELECT * FROM users WHERE id_user = :id_user");
        $request->bindParam(':id_user',$id);

        if($request->execute()) {
            if ($request->rowCount() == 1) {
                $class = "Model\Entity\\" . ucfirst('users');
                // utilise le bon mode de récupération selon la configuration
                $request->setFetchMode(\PDO::FETCH_CLASS, $class);
                return $request->fetch();
            }
        }
    }
   
    public function findAllTables(Users $users){

        $sql="SELECT
                u.id_user,
                u.last_name,
                u.first_name,
                u.email,
                u.password,
                u.role,
                u.birthday,
                u.address,
                u.phone_number,
                u.gender,
                b.id_booking,
                b.booking_start_date,
                b.booking_end_date,
                b.user_id,
                b.room_id,
                b.booking_price,
                b.booking_state,
                r.id_room,
                r.room_number,
                r.price,
                r.room_imgs,
                r.persons,
                r.category,
                r.room_state
            FROM
                bookings AS b
            JOIN
                users AS u ON b.user_id = u.id_user
            JOIN
                rooms AS r ON b.room_id = r.id_room
            WHERE
                b.booking_state IS NOT NULL
                AND b.booking_start_date != ''
                AND b.booking_end_date != ''
                AND b.user_id != :id_user
                AND b.room_id != :room_id
                AND b.booking_price != ''
                AND b.booking_state != ''";

    $request = $this->dbConnection->prepare($sql);
       
    // Lie la valeur pour :id_user; 
    $request->bindValue(":id_user", $users->getId_user(), \PDO::PARAM_INT); 
    // Assurez-vous de lier la valeur pour :room_id; 
    // $request->bindValue(":room_id", $bookings->getRoom_id(), \PDO::PARAM_INT);   

    // Exécute la requête avant de récupérer les résultats
    $request->execute();  

    // Récupère les résultats
    $results = $request->fetchAll(\PDO::FETCH_ASSOC);
 
    // Traite les résultats comme nécessaire
    return $results;
     
    }
    
    public function deleteUsersById($id)
    {
        $request = $this->dbConnection->prepare("DELETE FROM users WHERE id_user = :id_user");
        $request->bindParam(':id_user', $id);
    
        if ($request->execute()) {

            if ($request->rowCount() == 1) {

                Session::addMessage("success", "L'utilisateur a été supprimé avec succès");
                return true;

                } else {
                    Session::addMessage("danger", "Aucun utilisateur n'a été supprimé");
                    return false;
                }

        }else{

            Session::addMessage("danger", "Erreur lors de la suppression du utilisateur");
            return false;
        }
    }

}
