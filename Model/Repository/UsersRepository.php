<?php

namespace Model\Repository;

use Model\Entity\Users;
use Service\Session;

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
                // Assurez-vous d'utiliser le bon mode de récupération selon votre configuration
                $request->setFetchMode(\PDO::FETCH_CLASS, $class);
                return $request->fetch();
            }
        }
    }
   
    
    
}
