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
        <a class="navbar-brand" href="<?= addLink("home") ?>"></a>
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                
                <li class="nav-item">
                    <a class="nav-link active link-warning fw-bolder ms-md-4 me-md-3 fa-baht-sign fs-4" aria-current="page" href="<?= addLink("home") ?>">Accueil</a>
                </li>

                <?php 
                if( $user = Session::getConnectedUser() ): 
                ?>

                <li class="nav-item">
                    <a class="nav-link"
                    href="<?= addLink("user", "show", $user->getLast_name()) ?>">

                    <?php echo '<p class="last_name bg-success fw-medium m-lg-1 lead">Bienvenue ' . $user->getLast_name() . '</p>';?>
                    </a>
                </li>
                <li class="nav-item active mt-1">
                    <a class="nav-link" href="<?= addLink("users", "deco") ?>">
                        <i class="fa fa-sign-out me-md-3 m-lg-2"></i>
                    </a>
                </li>
                
                <?php if( $user = Session::isAdmin() ): ?>
                <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Chambres
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?= addLink('admin/admin', 'list') ?>">Liste</a></li>
                        <li><a class="dropdown-item" href="<?= addLink('admin/rooms', 'newRooms') ?>">Ajouter</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Utilisateurs
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?= addLink('admin/user', 'list') ?>">Liste</a></li>
                        <li><a class="dropdown-item" href="<?= addLink('admin/user', 'newUsers') ?>">Ajouter</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        categories
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?= addLink('admin/category', 'list') ?>">Liste</a></li>
                        <li><a class="dropdown-item" href="<?= addLink('admin/category', 'new') ?>">Ajouter</a></li>
                    </ul>
                </li>
                <?php endif; ?>

                <?php else: ?>
                <li class="nav-item active">
                    <a class="nav-link mt-1" href="<?= addLink("users", "login") ?>">
                        <i class="fa fa-sign-in me-md-3 m-lg-2"></i>
                    </a>
                </li>
                <?php endif ?>
                
                <li class="nav-item active mt-2 lead lh-1">
                    <a class="nav-link" href="<?= addLink("cart", "show") ?>">
                    <div class="ensemble d-flex">
                        <i class="fa fa-shopping-cart"></i>

                        <div class="num container fa" id="nombre"><?= $_SESSION["nombre"]; ?></div>

                    </div>
                    </a>
                </li>
            </ul>
            
            <form class="d-flex col-3" role="search" id="formSearch" action="<?= addLink("search", "searchTag");  ?>">
                <input class="form-control me-3 border-3 border-success bg-light" id="search" type="search" placeholder="Rechercher" aria-label="Search">
                <button class="btn bg-success link-warning fw-bolder border-2 border-light col-4" type="submit">Recherche</button>
            </form>
        </div>
    </nav>
</div>
    