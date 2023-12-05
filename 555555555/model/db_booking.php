<?php
session_start();
require_once $_SERVER["DOCUMENT_ROOT"]."/projetGite/inc/database.php";
// require_once $_SERVER["DOCUMENT_ROOT"]."http://projetGite.com/inc/database.php";
if(isset($_POST["book"])){
    // récuprer les infos
    $idRoom = htmlspecialchars($_POST["id_room"]);
    $startDate = htmlspecialchars($_POST["start_date"]);
    $endDate = htmlspecialchars($_POST["end_date"]);
    $price = htmlspecialchars($_POST["price"]);
    
    // convertir en date en seconde avec strtotime depuis le 1janvier 1960
    $dateStart = date("Ymd",strtotime($startDate));
    $dateEnd = date("Ymd",strtotime($endDate));

    $duration = strtotime($dateEnd) - strtotime($dateStart);

    $nbDays = $duration / 86400;
    $totalPrice = $price * $nbDays;

    // date du jour
    $today = date("Ymd");

    // si $today est > a la date de début de réservation ou $today est > à la date de fin de réservation
    if (strtotime($today) > strtotime($startDate) || strtotime($today) > strtotime($endDate)) {
        echo "Condition if true"; // Message de débogage
        echo '<script>alert("votre date de début ou de fin de réservation ne peut pas être inférieur à la date d aujourd\'hui");';
        echo 'window.location.href = "http://localhost/projetGite/booking.php?room='.$idRoom.'&price='.$price.'";</script>';
        exit(); // Arrête l'exécution du script
    
    }
    else{
        // se connecter à la bd
        $db = dbConnexion();
        // préparer la requête pour vérifier si la chambre est dispo entre la date de départ et la date de fin
        $request = $db->prepare("SELECT * FROM bookings WHERE room_id = ? AND ((booking_start_date <= ? AND booking_end_date >= ?) OR (booking_start_date <= ? AND booking_end_date >= ?))");
        // executer la requete
        try {
            $request->execute(array($idRoom, $startDate,$startDate, $endDate, $endDate));
            // recuperer le résultat
            $books = $request->fetch();
            if(empty($books)){
                if($startDate<$endDate){
                    //  preparer la requete pour reserver la chambre
                    $request = $db->prepare("INSERT INTO `bookings`(`booking_start_date`,`booking_end_date`,`user_id`, `room_id`, `booking_price`, `booking_state`) VALUES (?,?,?,?,?,?)");
                    // executer la requete
                    try{
                        // $request->execute(array($startDate,$endDate,$_SESSION["id_user"],$idRoom,$price*$nbDays,'in progress'));
                        $request->execute(array($startDate, $endDate, $_SESSION['id_user'], $idRoom, $totalPrice, "in progress"));

                        header("Location: http://localhost/projetGite/user_home.php");
                        // header("Location: http://projetGite.com/user_home.php");
    
                    // Réservation réussie
                    echo "Réservation réussie!";
                    } catch (PDOException $e) {
                        echo $e->getMessage();
                    }
                    
                } else {
                    // Dates invalides
                    echo "Les dates de réservation ne sont pas valides.";
                }
            }   else {
                // La chambre n'est pas disponible pour ces dates
                echo "La chambre n'est pas disponible pour les dates sélectionnées.";
            }
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
}

if(isset($_GET['id_book'])){
        // se connecter à la bd
        $db = dbConnexion();
        // préparer la requête pour annuler la réservation
        $request = $db->prepare("UPDATE bookings SET booking_state = ? WHERE id_booking = ?");
        // exécuter la requête
        try {
            $request->execute(array("cancel", $_GET['id_book']));
            // redirection vers user_home.php
            header("Location: http://localhost/projetGite/user_home.php");
            // header("Location: http://projetGite.com/user_home.php");
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
}