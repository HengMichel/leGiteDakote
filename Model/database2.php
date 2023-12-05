<?php
function dbConnexion(){
    $connexion = null;
    try {
        // $connexion = new PDO("mysql:host=localhost;dbname=id21228702_db_hotel","id21228702_admin","P@sser123");
        $connexion = new PDO("mysql:host=localhost;dbname=gite_db","root","");
    } catch (PDOException $e) {
        $connexion = $e->getMessage();
    }
    return $connexion;
}
?>