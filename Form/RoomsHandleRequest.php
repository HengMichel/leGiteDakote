<?php
namespace Form;

use Model\Entity\Rooms;
use Model\Repository\RoomsRepository;

class RoomsHandleRequest extends BaseHandleRequest
{
    private $roomsRepository;

    public function __construct()
    {
        $this->roomsRepository  = new RoomsRepository;
    }

    public function RoomsHandleForm(Rooms $rooms)
    {
// d_die($_POST);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') 
        {
            extract($_POST);
            $errors = [];
// d_die($_POST);
            // Vérification de la validité du formulaire
            if (empty($room_number)) {
                $errors[] = "Le N° de chambre ne peut pas être vide";
            }
            if (strlen($room_number) < 1) {
                $errors[] = "Le N° de chambre doit avoir au moins 1 caractères";
            }
            if (strlen($room_number) > 3) {
                $errors[] = "Le N° de chambre doit avoir au maximum 3 caractères";
            }
            // Vérifie si un fichier a été téléchargé
            if ($_FILES["room_imgs"]["error"] === UPLOAD_ERR_OK) {
                // Récupère les informations sur le fichier téléchargé
                $room_imgs = $_FILES['room_imgs']['name'];
            } else {
                $errors[] = "Veuillez sélectionner une image à télécharger pour continuer.";
            }
            // Validation du prix
            if (!isset($_POST['price']) || empty(trim($_POST['price']))) {
                $errors[] = "Le prix ne peut pas être vide";
            } else {
                // Conversion du prix en float
                $price = floatval($_POST['price']);
            }   
           // Validation du champ "persons"
            if (!isset($_POST['persons']) || empty(trim($_POST['persons']))) {
                $errors[] = "Le nombre de personnes ne peut pas être vide";
            } else {
                // Vérifie si la valeur est un entier positif
                $persons = intval($_POST['persons']);
                if ($persons <= 0) {
                    $errors[] = "Le nombre de personnes doit être un entier positif";
                }
            }
            if (!empty($category)) {
                if (empty($category)) {
                    $errors[] = "La category ne peut pas être vide";
                }
            } 
            // d_die($_POST);
   
            if (empty($errors)) {
                $rooms->setRoom_number($room_number);
                $rooms->setRoom_imgs($room_imgs);
                $rooms->setPrice($price);
                $rooms->setPersons($persons);
                $rooms->setCategory($category);
            // d_die($rooms);
                return $this;
            }
            $this->setEerrorsForm($errors);
            return $this;
        }
    }
}