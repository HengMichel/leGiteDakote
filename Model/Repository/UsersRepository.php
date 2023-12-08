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
                Session::addMessage("success",  "Le nouvel utilisateur a bien été enregistré");
                return true;
            }
            Session::addMessage("danger",  "Erreur : l'utilisateur n'a pas été enregisté");
            return false;
        }
        Session::addMessage("danger",  "Erreur SQL");
        return null;
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

    public function logUsers(Users $users)
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $request = $this->dbConnection->prepare($sql);
        $request->bindValue(":email", $users->getEmail());
        try {
            
            $result = $request->execute();
            if ($result) {

                $userInfo = $request->fetch(\PDO::FETCH_ASSOC);

                if (empty($userInfo)) {
                    echo "Utilisateur inconnu";
                }else{

                    if (password_verify($users->getPassword(), $userInfo["password"])) {

                        $_SESSION["role"] = $userInfo["role"];
                        $_SESSION["id_user"] = $userInfo["id_user"];

                        // Si l'utilisateur est un admin
                        if ($userInfo["role"] == "admin") {
                            header("admin/home");
                            exit;
                        }else{
                            header("users/dashboard_users.php");
                            exit;
                        }

                    }else{
                        echo "Mot de passe incorrect";
                    }
                }
            }else{        
                Session::addMessage("danger", "Erreur : la connexion n'a pas réussi");
                return false;
            }

        } catch (\PDOException $ex) {
            Session::addMessage("danger", "Erreur SQL : " . $ex->getMessage());
            return false;
        }
    }

    public function logoutUsers(Users $users)
    {
        Session::destroy();
    } 
    
}
