<?php
use Service\Session; 

// Vérifier si la session est déjà active
if (session_status() == PHP_SESSION_NONE) {
    // Si elle n'est pas active, démarrer la session
    session_start();
}

?>

<nav class="navbar navbar-expand-lg mb-5 bg-dark">
    <div class="container-fluid bg-black link-warning">
        <a class="navbar-brand link-warning" href="<?= addLink("home") ?>">Accueil</a>
        <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarText">
            <ul class="navbar-nav mb-2 mb-lg-0 link-warning bg-black">

                <li class="nav-item d-flex">
                <?php 
                // Vérifier si l'utilisateur est connecté
                if (Session::isConnected()) {
                    $user = $_SESSION['users'];
                // ... le reste du code pour afficher le nom de l'utilisateur
                    if (isset($user) && $user !== null) {
                    echo '<p class="last_name bg-success fw-medium m-lg-2 lead">Bienvenue ' . $user->getLast_name() . '</p>'; 
                 // Ajout du bouton de déconnexion
                    echo '<a class="nav-link fw-medium link-light bg-danger border border-3" href="' . addLink("users", "deco") . '">Se déconnecter</a>';
                        }
                    } ?>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link active link-warning" aria-current="page" href="<?= addLink("rooms") ?>">La liste des chambres</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link link-warning" href="<?= addLink("home","serviceDuGite") ?>">Nos Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link link-warning" href="<?= addLink("users","login") ?>">Se connecter</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link link-warning" href="<?= addLink("users","newUsers") ?>">S'inscrire</a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link link-warning" href="<?= addLink("admin/admin","home") ?>">admin home</a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link link-warning" href="<?= addLink("admin","home") ?>">admin home</a>
                </li>
               
            </ul>
        </div>
    </div>
</nav>
