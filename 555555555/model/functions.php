<?php
require_once(__DIR__ . '/../inc/database.php');

function  userBookList($idUser){
    //  se connecter a la db (database) ou bd (base de données)
    $db = dbConnexion();
    // preparer la requete
    $request = $db->prepare("SELECT * FROM bookings WHERE user_id = ? AND booking_state = ?");
    // executer la requete
    $userBookList = null;
    try {
        $request->execute(array($idUser,'in progress'));
        // récuperer le resultat dans un tableau
        $userBookList = $request->fetchAll(PDO::FETCH_ASSOC);
    } catch ( PDOException $e) {
        echo $e->getMessage();
    }
    return $userBookList;
}