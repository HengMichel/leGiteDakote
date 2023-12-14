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

    public function logUsers(Users $users , $password)
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $request = $this->dbConnection->prepare($sql);
        $request->bindValue(":email", $users->getEmail());
        
        try {
            $result = $request->execute();
    
            if ($result) {
                $request->setFetchMode(\PDO::FETCH_CLASS, "Model\Entity\Users");
                $userInfo = $request->fetch();
    
                if (empty($userInfo)) {
                    Session::addMessage("danger", "Utilisateur inconnu");
                } else {
                    // if (password_verify($users->getPassword(), $userInfo->getPassword())) {
                        if (password_verify($password, $userInfo->getPassword())) {

                        $_SESSION["role"] = $userInfo->getRole();
                        $_SESSION["id_user"] = $userInfo->getId_user();
    
                        // Redirection en fonction du rôle
                        $redirectLocation = ($userInfo->getRole() == "admin") ? "admin/dashboard_admin.php" : "dashboard_users.php";
                        header("Location: $redirectLocation");
                        exit;
                    } else {
                        Session::addMessage("danger", "Mot de passe incorrect");
                    }
                }
            } else {
                Session::addMessage("danger", "Erreur : la connexion n'a pas réussi");
                return false;
            }
        } catch (\PDOException $ex) {
            Session::addMessage("danger", "Erreur SQL : " . $ex->getMessage());
            return false;
        }
    }
    
    // public function logoutUsers(Users $users)
    // {
    //     Session::destroy();
    // } 
    
    
}
