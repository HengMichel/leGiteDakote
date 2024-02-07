<?php
use Service\Session; 

// Vérifier si la session est déjà active
if (session_status() == PHP_SESSION_NONE) {
    // Si elle n'est pas active, démarrer la session
    session_start();
}
?>
<div class="container-fluid bg-dark">
    <nav class="navbar-expand-lg "> 
        <a class="navbar-brand" href="<?= addLink("home") ?>">
        </a>     
        <div class="collapse navbar-collapse"  id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">         
                <li class="nav-item">
                    <a class="nav-link active link-warning fw-bolder ms-md-4 me-md-3 fa-baht-sign fs-4" aria-current="page" href="<?= addLink("home") ?>">Accueil
                    </a>
                </li>
<!-- connexion avec le message Bienvenue suivi du nom -->
                <?php
                if( $user = Session::getConnectedUser() ): 
                ?>
                <li class="nav-item">
                    <a class="nav-link me-md-3"
                    href="<?= addLink("users", "show", $user->getId_user()) ?>">
                    <?php echo '<p class="last_name bg-success fw-medium m-lg-1 lead">Bienvenue ' . $user->getLast_name() . '</p>';?>
                    </a>
                </li>

<!-- déconnexion -->
                <li class="nav-item active mt-2">
                    <a class="nav-link" href="<?= addLink("users", "deco") ?>">
                        <i class="fa fa-sign-out me-md-3  fa-2xl"></i>
                    </a>
                </li>
                
<!-- connexion de l'admin et acces de tous ses avantages -->
                <?php if( Service\Session::isAdmin() ): ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle fw-bolder fs-4" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false" >
                    Chambres
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?= addLink('admin/rooms', 'list') ?>">Liste</a></li>
                        <li><a class="dropdown-item" href="<?= addLink('admin/rooms', 'newRooms') ?>">Ajouter</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle fw-bolder ms-md-2 fs-4" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Utilisateurs
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?= addLink('admin/users', 'list') ?>">Liste</a></li>
                        <li><a class="dropdown-item" href="<?= addLink('admin/user', 'newUsers') ?>">Ajouter</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle fw-bolder ms-md-2 fs-4" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Réservations
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?= addLink('admin/bookings', 'list') ?>">Liste</a></li>
                        <li><a class="dropdown-item" href="<?= addLink('admin/category', 'new') ?>">Ajouter</a></li>
                    </ul>
                </li>
                <?php endif; ?>

<!-- connexion -->
                <?php else: ?>
                <li class="nav-item active">
                    <a class="nav-link mt-1" href="<?= addLink("users", "login") ?>">
                        <i class="fa fa-sign-in me-md-3  fa-2xl"></i>
                    </a>
                </li>
                <?php endif ?>
                
                <!-- <li class="nav-item active mt-2 lead lh-1">
                    <a class="nav-link" href="<?= addLink("cart", "show") ?>">
                    <div class="ensemble d-flex">
                        <i class="fa fa-shopping-cart"></i>                  
                        <div class="num container fa" id="nombre"><?= $_SESSION["nombre"] ?? ''; ?>
                        </div>
                        
                    </div>
                    </a>
                </li> -->

<!-- access aux services  -->
                <li class="nav-item">
                    <a class="nav-link link-warning fw-bolder ms-md-4 me-md-3 fs-4" href="<?= addLink("home","serviceDuGite") ?>">Nos Services</a>
                </li>
                
<!-- inscription -->
                <li class="nav-item">
                    <a class="nav-link link-warning fw-bolder ms-md-4 me-md-3 fs-4" href="<?= addLink("users","newUsers") ?>">S'inscrire</a>
                </li>

<!-- présentation des propriétaire -->
                <li class="nav-item">
                    <a class="nav-link link-warning fw-bolder ms-md-4 me-md-3 fs-4" href="<?= addLink("home","aboutUs") ?>">à propos de nous</a>
                </li>
            </ul>
        </div>
    </nav>
</div>
