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

    public function handleForm(Rooms $rooms)
    {
        if (isset($_POST['submit'])) {

            extract($_POST);
            $errors = [];

            // Vérification de la validité du formulaire
            if (empty($room_number)) {
                $errors[] = "Le titre ne peut pas être vide";
            }
            if (strlen($room_number) < 1) {
                $errors[] = "Le titre doit avoir au moins 1 caractères";
            }

            // if (!empty($room_imgs)) {
            //     if (strlen($room_imgs)) {
            //         $errors[] = "La room_imgs ne peut pas être vide";
            //     }
            // }
            if (!(isset($_FILES["room_imgs"]) && $_FILES["room_imgs"]["error"] == UPLOAD_ERR_OK)) {
                $errors[] = "Veuillez sélectionner une image à télécharger pour continuer.";
            }
            // Est-ce que L'image existe déjà dans la bdd ?
            $requete = $this->roomsRepository->findByAttributes($rooms, ["room_imgs" => $room_imgs]);
            if ($requete) {
                $errors[] = "L'image de la rooms existe déjà, veuillez en choisir un nouveau";
            }

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
                if (strlen($category)) {
                    $errors[] = "La category ne peut pas être vide";
                }
            }    
            
            if (empty($errors)) {
              
                $rooms->setRoom_number($room_number);
                $rooms->setRoom_imgs($room_imgs);
                $rooms->setPrice($Price);
                $rooms->setPersons($persons);
                $rooms->setCategory($category);
                // return true;
                return $this;
            }

            $this->setEerrorsForm($errors);
            return $this;

        }
    }

    // public function handleUpdate($id)
    // {
    //     if (isset($_GET['idUser'])) {

    //         $idUser = htmlspecialchars($_GET['idUser']);
        
    //         User::UserById($idUser);
    //     }
    // }
    public function handleSecurity()
    {
       
        
    }
}