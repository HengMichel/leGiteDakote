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
                <li class="nav-item">
                    <a class="nav-link link-warning" href="<?= addLink("admin","home") ?>" onclick="updateIcon(true)"><i class="fa-solid fa-cart-shopping link-primary" id="cart-shopping"></i></a>
                </li>    

                <li class="nav-item active">
                    <a class="nav-link" href="<?= addLink("cart", "show")
                    // peut etre le dashboard_users pour moi 
                    ?>">
                        <i class="fa fa-shopping-cart"></i>

                        <div id="nombre"><?= $_SESSION["nombre"] ?? ''; ?></div>
                    </a>
                </li>
            </ul>

            <form class="d-flex" role="search" id="formSearch" action="<?= addLink("search", "searchTag");  ?>">
                <input class="form-control me-2 bg-light fw-bold" id="search" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-warning bg-warning link-success fw-medium" type="submit">Recherche</button>
            </form>
        </div>
    </div>
</nav>




<div class="container-fluid">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="<?= addLink("home") ?>"></a>
      

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?= addLink("home") ?>">Home</a>
                </li>
                <?php 
                if( $userConnecte = Service\Session::isConnected() ): 
                ?>

                
                <li class="nav-item">
                    <a class="nav-link"
                        href="<?= addLink("user", "show", $userConnecte->getId()) ?>"><?= $userConnecte->getSurname() ?></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="<?= addLink("user", "logout") ?>">
                        <i class="fa fa-sign-out"></i>
                    </a>
                </li>

                <?php if( Service\Session::isadmin() ): ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Produits
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?= addLink('admin/admin', 'list') ?>">Liste</a></li>
                        <li><a class="dropdown-item" href="<?= addLink('admin/product', 'new') ?>">Ajouter</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Utilisateurs
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?= addLink('admin/user', 'list') ?>">Liste</a></li>
                        <li><a class="dropdown-item" href="<?= addLink('admin/user', 'new') ?>">Ajouter</a></li>
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
                    <a class="nav-link" href="<?= addLink("user", "login") ?>">
                        <i class="fa fa-sign-in"></i>
                    </a>
                </li>
                <?php endif ?>

                <li class="nav-item active">
                    <a class="nav-link" href="<?= addLink("cart", "show") ?>">
                        <i class="fa fa-shopping-cart"></i>

                        <div id="nombre"><?= $_SESSION["nombre"] ?? ''; ?></div>
                    </a>
                </li>
            </ul>


            <form class="d-flex" role="search" id="formSearch" action="<?= addLink("search", "searchTag");  ?>">
                <input class="form-control me-2" id="search" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </nav>
</div>