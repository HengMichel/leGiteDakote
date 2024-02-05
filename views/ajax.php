<?php
//Crée une variable $tab de type tableau
$tab = array();

//Ajoute un indice 'contenu' pour ce tableau. La valeur doit être une chaîne de caractères vide
$tab['contenu'] = '';


//Applique la condition pour vérifier si "empty($_POST['choix'])" n'est pas vide
if (!empty($_POST['choix'])){

//Récupère la méthode findRoomsByCategory() en mettant dans une variable '$methode'
    $methode->findRoomsByCategory();
    var_dump($methode);


    // Convertir le fichier JSON en tableau PHP en stockant dans la variable '$json'
    $json = json_decode($methode, true);

    // Récupérer le nom sélectionné
    $choix = $_POST['choix'];

// Affichez la liste des chambres
    foreach ($roomss as $rooms) {

        if($rooms['classic'] === $choix) {

            $tab['contenu'] .= 
             '<div class="card border-light border-2 mt-5" style="width: 22rem;">';
            // ... Affichez le contenu de chaque chambre ...
        }
        else if ($rooms['piscine'] === $choix) {

            $tab['contenu'] .= 
             '<div class="card border-light border-2 mt-5" style="width: 22rem;">';

        }
    }
     //Converti le tableau '$tab' en JSON
     echo json_encode($tab);
}
?>



