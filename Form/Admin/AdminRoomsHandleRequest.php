<?php

namespace Form\Admin;

use Model\Entity\Rooms;
use Form\BaseHandleRequest;
use Model\Repository\Admin\AdminRoomsCrudRepository;

class AdminRoomsHandleRequest extends BaseHandleRequest
{
    private $roomsRepository;

    public function __construct()
    {
        $this->roomsRepository  = new AdminRoomsCrudRepository;
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

            if (!empty($room_imgs)) {
                if (strlen($room_imgs)) {
                    $errors[] = "La room_imgs ne peut pas être vide";
                }
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
                return true;
            }

            $this->setEerrorsForm($errors);
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