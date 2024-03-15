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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // d_die($_POST);
        // if (isset($_POST['add_room'])) {
            extract($_POST);
            $errors = [];
        d_die($_POST);

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
// ancienne version 
            // if (empty($room_imgs)) {
            //         $errors[] = "Le fichier image ne peut pas être vide";
            // }
            
// #################
// Vérifie si un fichier a été téléchargé
// if ($_FILES["room_imgs"]["error"] === UPLOAD_ERR_NO_FILE) {
    // $errors[] = "Le fichier image ne peut pas être vide";
// }

            if (!(isset($_FILES["room_imgs"]) && $_FILES["room_imgs"]["error"] === UPLOAD_ERR_OK)) {
                $room_imgs = ''; // Initialisation à une valeur par défaut
            } else {
                 // Récupérez les informations sur le fichier téléchargé
        $room_imgs = $_FILES['room_imgs']['name'];
        // Continuez votre traitement avec $room_imgs
    // } else {
                $errors[] = "Veuillez sélectionner une image à télécharger pour continuer.";
            }
            // Est-ce que L'image existe déjà dans la bdd ?
            // $requete = $this->roomsRepository->findByAttributes($rooms, ["room_imgs" => $room_imgs]);
            // if ($requete) {
            //     $errors[] = "L'image de la rooms existe déjà, veuillez en choisir un nouveau";
            // }

            if (!empty($price)) {
                if (strlen($price)) {
                    $errors[] = "Le price ne peut pas être vide";
                }
                
            }
            if (!empty($persons)) {
                if (strlen($persons)) {
                    $errors[] = "Les persons ne peut pas être vide";
                }
            }
            if (!empty($category)) {
                if (empty($category)) {
                    $errors[] = "La category ne peut pas être vide";
                }
            }    
            
            if (empty($errors)) {
    // d_die($room_number);
                $rooms->setRoom_number($room_number);
                $rooms->setRoom_imgs($room_imgs);
                $rooms->setPrice($price);
                $rooms->setPersons($persons);
                $rooms->setCategory($category);
                return $this;
            }

            $this->setEerrorsForm($errors);
            return $this;

        }
    }
    // }

  
    public function handleSecurity()
    {
       
        
    }
}