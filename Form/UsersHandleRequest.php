<?php

namespace Form;

use Model\Entity\Users;
use Model\Repository\UsersRepository;

class UsersHandleRequest extends BaseHandleRequest
{
    private $usersRepository;

    public function __construct()
    {
        $this->usersRepository  = new UsersRepository;
    }

    public function handleForm(Users $users)
    {
        if (isset($_POST['submit'])) {

            extract($_POST);
            $errors = [];

            // Vérification de la validité du formulaire
            if (empty( $email)) {
                $errors[] = "L'email ne peut pas être vide";
            }
            if (strlen( $email) < 2) {
                $errors[] = "L'email doit avoir au moins 2 caractères";
            }
            if (strlen( $email) > 20) {
                $errors[] = "L'email ne peut avoir plus de 20 caractères";
            }

            if (!strpos( $email, " ") === false) {
                $errors[] = "Les espaces ne sont pas autorisés pour l'email";
            }

            // Est-ce que le pseudo existe déjà dans la bdd ?

            // $request = $this->playerRepository->findByPseudo($pseudo);
            $request = $this->usersRepository->findByAttributes($users, ["email" =>  $email]);
            if ($request) {
                $errors[] = "L'email  existe déjà, veuillez en choisir un nouveau";
            }

            if (!empty($last_name)) {
                if (strlen($last_name) < 1) {
                    $errors[] = "Le last_name doit avoir au moins 2 caractères";
                }
                if (strlen($last_name) > 100) {
                    $errors[] = "Le last_name ne peut avoir plus de 100 caractères";
                }
            }
            if (!empty($first_name)) {
                if (strlen($first_name) < 1) {
                    $errors[] = "Le first_name doit avoir au moins 2 caractères";
                }
                if (strlen($first_name) > 100) {
                    $errors[] = "Le first_name ne peut avoir plus de 100 caractères";
                }
            }    
            if (empty($password)) {
                $errors[] = "Le mot de passe ne peut pas être vide";
            }
            if (!empty($role)) {
                if (strlen($role)) {
                    $errors[] = "Le role ne peut pas être vide";
                }
            }
            if (!empty($birthday)) {
                if (strlen($birthday)) {
                    $errors[] = "Le birthday ne peut pas être vide";
                }
            }    
            if (!empty($address)) {
                if (strlen($address) < 1) {
                    $errors[] = "Le address doit avoir au moins 2 caractères";
                }
                if (strlen($address) > 100) {
                    $errors[] = "Le address ne peut avoir plus de 100 caractères";
                }
            }    
            if (!empty($phone_number)) {
                if (strlen($phone_number) < 10) {
                    $errors[] = "Le phone_number doit avoir au moins 10 caractères";
                }
                if (strlen($phone_number) > 20) {
                    $errors[] = "Le phone_number ne peut avoir plus de 20 caractères";
                }
            }    
            if (!empty($gender)) {
                if (strlen($gender)) {
                        $errors[] = "Le gender ne peut pas être vide";
                }
            }
            
            if (empty($errors)) {
                
                $users->setPassword(password_hash($password, PASSWORD_DEFAULT));
                $users->setLast_name($last_name);
                $users->setFirst_name($first_name);
                $users->setEmail($email);
                $users->setRole($role);
                $users->setBirthday($birthday);
                $users->setAddress($address);
                $users->setPhone_number($phone_number);
                $users->setGender($gender);
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