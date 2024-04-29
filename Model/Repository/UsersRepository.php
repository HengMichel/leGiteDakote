<?php

namespace Model\Repository;

use PDOException;
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
        if ($request) 
        {
            if ($request == 1) 
            {
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
        if($request->execute()) 
        {
            if ($request->rowCount() == 1) 
            {
                $class = "Model\Entity\\" . ucfirst('users');
                // utilise le bon mode de récupération selon la configuration
                $request->setFetchMode(\PDO::FETCH_CLASS, $class);
                return $request->fetch();
            }
        }
    }

    public function updateUsers(Users $users)
    {
        try 
        {
            // Début de la transaction
            $this->dbConnection->beginTransaction();

            $sql = "UPDATE users 
                    SET email = :email, password = :password, address = :address, phone_number = :phone_number
                    WHERE id_user = :id_user";
            $request = $this->dbConnection->prepare($sql);
            $request->bindValue(":id_user", $users->getId_user());
            $request->bindValue(":email", $users->getEmail()); 
            $request->bindValue(":password", $users->getPassword()); 
            $request->bindValue(":address", $users->getAddress()); 
            $request->bindValue(":phone_number", $users->getPhone_number()); 
            // d_die($request);
            $success = $request->execute();
            // d_die($success);
             // Si la requête s'est exécutée avec succès, commit la transaction
            if ($success) 
            {
                $this->dbConnection->commit();
                // La modification a réussi
                return true; 
            } else 
            {
                // Rollback de la transaction en cas d'échec de la requête
                $this->dbConnection->rollBack();
                // La modification a échoué
                return false; 
            }
        } catch (PDOException $e) 
        {
            $this->dbConnection->rollBack();
            // Gère les erreurs, par exemple :
            echo "Erreur : " . $e->getMessage();
            // La modification à échoué
            return false; 
        }
    }
    
    public function deleteUsersById($id)
    {
        $request = $this->dbConnection->prepare("DELETE FROM users WHERE id_user = :id_user");
        $request->bindParam(':id_user', $id);
        if ($request->execute()) 
        {
            if ($request->rowCount() == 1) 
            {
                Session::addMessage("success", "L'utilisateur a été supprimé avec succès");
                return true;               
            } else 
                {
                    Session::addMessage("danger", "Aucun utilisateur n'a été supprimé");
                    return false;
                }
        }else
        {
            Session::addMessage("danger", "Erreur lors de la suppression du utilisateur");
            return false;
        }
    }
}
