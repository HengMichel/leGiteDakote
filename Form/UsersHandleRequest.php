<?php

namespace Form;

use Model\Entity\Users;
use Model\Repository\UsersRepository;
use Service\Session;

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

            // Est-ce que l'email existe déjà dans la bdd ?
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
                    $errors[] = "Le nom de famille doit avoir au moins 2 caractères";
                }
                if (strlen($first_name) > 100) {
                    $errors[] = "Le nom de famille ne peut avoir plus de 100 caractères";
                }
            }    
            if (empty($password)) {
                $errors[] = "Le mot de passe ne peut pas être vide";
            }
           
            if (empty($birthday)) {
                    $errors[] = "Le birthday ne peut pas être vide";
                
            }    
            if (!empty($address)) {
                if (strlen($address) < 6) {
                    $errors[] = "L'addresse doit avoir au moins 6 caractères";
                }
                if (strlen($address) > 100) {
                    $errors[] = "L'addresse ne peut avoir plus de 100 caractères";
                }
            }    
            if (!empty($phone_number)) {
                if (strlen($phone_number) < 10) {
                    $errors[] = "Le numéro de téléphone doit avoir au moins 10 caractères";
                }
                if (strlen($phone_number) > 20) {
                    $errors[] = "Le numéro de téléphone ne peut avoir plus de 20 caractères";
                }
                if (!strpos( $phone_number, " ") === false) {
                    $errors[] = "Les espaces ne sont pas autorisés pour le numéro de téléphone";
                }
            }    
            if (empty($gender)) {
                        $errors[] = "Le gender ne peut pas être vide";
            }
            
            if (empty($errors)) {
                
                $users->setPassword(password_hash($password, PASSWORD_DEFAULT));
                $users->setLast_name($last_name);
                $users->setFirst_name($first_name);
                $users->setEmail($email);
                // default value Role in bdd 'client' 
                $defaultRole = 'client';
                $users->setRole($defaultRole);
                $users->setBirthday($birthday);
                $users->setAddress($address);
                $users->setPhone_number($phone_number);
                $users->setGender($gender);
                return true;
            }

            $this->setEerrorsForm($errors);
        }
    }

    public function handleSecurity(Users $users)
    {
        // if (isset($_POST['submit'])) {
            if (!empty($_POST)) {
           
            extract($_POST);
            $errors = [];

            // Vérification de la validité du formulaire
            if (empty( $email)) {
                $errors[] = "L'email ne peut pas être vide";
            }    
            if (strlen($email) < 2) {
                $errors[] = "L'email doit avoir au moins 2 caractères";
            }
            if (strlen($email) > 20) {
                $errors[] = "L'email ne peut avoir plus de 20 caractères";
            }
            if (strpos($email, " ") !== false) {
                $errors[] = "Les espaces ne sont pas autorisés pour l'email";
            }
            // Est-ce que l'email existe déjà dans la bdd ?
            $request = $this->usersRepository->findByAttributes($users, ["email" =>  $email]);
            if($request){
                "Bienvenue" ." ". $request;
            }
            
            if (empty($password)) {
                $errors[] = "Le mot de passe ne peut pas être vide";
            // }else {
            //     if (!password_verify($password, $users->getPassword())) {
            //         $errors[] = "Mot de passe incorrect";
            //     }
            }      
            if (empty($errors)) {
                $users->setPassword(password_hash($password, PASSWORD_DEFAULT));
                $users->setEmail($email);
                return true;
            }
            $this->setEerrorsForm($errors);
        }
    }
    
}