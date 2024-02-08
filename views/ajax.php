<?php

use Model\Repository\RoomsRepository;

//Création d' une variable $tab de type tableau
$tab = array();
// Avant la conversion en JSON
var_dump($tab);

//Applique la condition pour vérifier si "empty($_POST['choix'])" n'est pas vide
if (!empty($_POST['choix'])){

    $roomsRepository = new RoomsRepository();

    // Récupère la valeur de la catégorie depuis la requête POST
    $category = $_POST['choix'];
 
    // Appelle la méthode findRoomsByCategory avec la catégorie pour récupérer les chambres filtrées
    $rooms = $roomsRepository->findRoomsByCategory($category);
 
    // Si des chambres ont été trouvées, renvoie l'URL de redirection vers show.php pour la première chambre
    if (!empty($rooms)) {
         $firstRoomId = $rooms[0]['id']; // Supposons que 'id' est le champ identifiant de la chambre
         $tab['redirectUrl'] = "rooms/show.php?id=" . $firstRoomId;
        }
    }
    //Converti le tableau '$tab' en JSON
    echo json_encode($tab);
    echo $jsonResponse;

?>



