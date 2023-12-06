<?php
session_start();
require_once "../inc/database.php";

if (isset($_POST["submit"])) {
    $email = htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);

    //etablir la connexion avec la bd
    $db = dbConnexion();

    $e = null; // Initialiser $e à null

    try {// preparer la requete
        $request = $db->prepare("SELECT * FROM users WHERE email = ?");
        // executer la requete
        $request->execute(array($email));
         // recuperer le resultat de la requete qui est toujours un objet
        $userInfo = $request->fetch(PDO::FETCH_ASSOC);

        if (empty($userInfo)) {
            //definir la variable de session role

            echo "Utilisateur inconnu";
        } else {
            if (password_verify($password, $userInfo["password"])) {
                $_SESSION["role"] = $userInfo["role"];
                $_SESSION["id_user"] = $userInfo["id_user"];

                //si l'utilisateur est un admin
                if ($userInfo["role"] == "admin") {
                    header("Location: http://localhost/projetGite/admin/admin.php");
                    exit;
                } else {
                    header("Location: http://localhost/projetGite/user_home.php");
                    exit;
                }
            } else {
                echo "Mot de passe incorrect";
            }
        }
    } catch (PDOException $ex) {
        // Assigner l'exception à $e
        $e = $ex;
    }

    // Vérifier si $e est définie
    if ($e !== null) {
        echo "Erreur : " . $e->getMessage();
    }
}
