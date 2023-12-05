<?php
// require_once $_SERVER["DOCUMENT_ROOT"]."/inc/database.php";
require_once "./inc/database.php";

function  roomList(){
    //  se connecter a la db (database) ou bd (base de données)
    $db = dbConnexion();
    // preparer la requete
    $request = $db->prepare("SELECT * FROM rooms");
    // executer la requete
    $listRoom = null;
    try {
        $request->execute();
        // récuperer le resultat dans un tableau
        $listRoom = $request->fetchAll(PDO::FETCH_ASSOC);
    } catch ( PDOException $e) {
        echo $e->getMessage();
    }
    return $listRoom;
}

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