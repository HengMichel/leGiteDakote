<?php
// Démarrez la session si ce n'est pas déjà fait
session_start();

// Détruisez la session actuelle
session_destroy();

// Redirigez l'utilisateur vers la page d acceuil
header("Location: http://localhost/projetGite/index.php"); 
// header("Location: http://projetGite.com/index.php"); 
?>
