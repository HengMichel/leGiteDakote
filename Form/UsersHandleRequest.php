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
        if (isset($_POST['submit'])) 
        {
            extract($_POST);
            $errors = [];
            // Vérification de la validité du formulaire
            if (empty( $email)) {
                $errors[] = "L'email ne peut pas être vide";
            }
            if (strlen( $email) < 11) {
                $errors[] = "L'email doit avoir au moins 11 caractères";
            }
            if (strlen( $email) > 50) {
                $errors[] = "L'email ne peut avoir plus de 50 caractères";
            }
            if (!strpos( $email, " ") === false) {
                $errors[] = "Les espaces ne sont pas autorisés pour l'email";
            }
            if (empty( $email) . "@" === false) {
                $errors[] = "L'email n'est pas valide";
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
                    $errors[] = "La date de naissance ne peut pas être vide";          
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
                if (strlen($phone_number) < 0) {
                        $errors[] = "La section 'Civilité' est vide merci de le compléter";
                }
                if (strlen($phone_number) > 1) {
                        $errors[] = "Vous ne pouvez avoir qu'une seule civilité";
                }
            }
            if (empty($errors)) {             
                $users->setPassword(password_hash($password, PASSWORD_DEFAULT));
                $users->setLast_name($last_name);
                $users->setFirst_name($first_name);
                $users->setEmail($email);
                $users->setBirthday($birthday);
                $users->setAddress($address);
                $users->setPhone_number($phone_number);
                $users->setGender($gender);
                return true;
            }
            $this->setEerrorsForm($errors);
        }
    }

    public function handleSecurity()
    {
        if (isset($_POST['submit'])) {
   
            extract($_POST);
            $errors = [];
            if (!empty($_POST)) {
                // Vérification de la validité du formulaire
                if (empty($email) || empty($password)) {
                    $errors[] = "L'email et le mot de passe ne peuvent pas être vides";
                } else {
                    // Est-ce que l'email existe déjà dans la bdd ?
                    $userInfo = $this->usersRepository->findByAttributes("users", ["email" => $email]);
                    if (empty($userInfo)) {
                        $errors[] = "Utilisateur inconnu !";
                    } else {
                        // Vérifie si le mot de passe est correct
                        if (!password_verify($password, $userInfo->getPassword())) {
                            $errors[] = "Le mot de passe est incorrect";
                        }
                    }
                }
            } else {
                $errors[] = "L'email et le mot de passe ne peuvent pas être vides";
            }
            if (!empty($errors)) {
                $this->setEerrorsForm($errors);
                return null;
            }
            return $userInfo;
        }
    }
}