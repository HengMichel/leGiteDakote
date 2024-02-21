<?php
use Service\Session; 

// Vérifie si la session est déjà active
if (session_status() == PHP_SESSION_NONE) {
    // Si elle n'est pas active, démarrer la session
    session_start();
}
?>
<div class="container-fluid bg-dark">
    <nav class="navbar-expand-lg m-2"> 
    
        <button type="button" class="btn btn-outline-warning  fw-semibold">
            <a class="nav-link active link-light " aria-current="page" href="<?= addLink("home") ?>"> <i class="fa fa-home me-1"></i>Accueil
            </a>
        </button>

<!-- connexion avec le message Bienvenue suivi du nom -->
            <?php
                if( $user = Session::getConnectedUser() ): 
            ?>
        <button type="button" class="btn btn-outline-warning fw-semibold">
            <a class="nav-link"
                    href="<?= addLink("users", "show", $user->getId_user()) ?>">
                    <?php echo 'Bienvenue ' . $user->getLast_name() . '';?>
            </a>
        </button>

<!-- déconnexion -->
        <button type="button" class="btn btn-outline-warning fw-semibold">
            <a class="nav-link" href="<?= addLink("users", "deco") ?>">déconnexion
                <i class="fa fa-sign-out fa-2xl"></i>
            </a>
        </button>

<!-- connexion de l'admin et acces de tous ses avantages -->
<?php if( Service\Session::isAdmin() ): ?>
        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
            <button type="button" class="btn btn-outline-warning fw-semibold">
                Chambres
            </button>
            <div class="btn-group" role="group">
                <button id="btnGroupDrop1" type="button" class="btn btn-warning dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                </button>
                <div class="dropdown-menu lh-1" aria-labelledby="btnGroupDrop1" 
                style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 40px);" data-popper-placement="bottom-start"
                >
                    <a class="dropdown-item fw-bolder" href="<?= addLink('admin/rooms', 'list') ?>">Liste</a>
                    <a class="dropdown-item fw-bolder" href="<?= addLink('admin/rooms', 'newRooms') ?>">Ajouter</a>
                </div>
            </div>
        </div>

        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
            <button type="button" class="btn btn-outline-warning fw-semibold">
            Réservations
            </button>
            <div class="btn-group" role="group">
                <button id="btnGroupDrop2" type="button" class="btn btn-warning dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                </button>
                <div class="dropdown-menu lh-1" aria-labelledby="btnGroupDrop2">
                    <a class="dropdown-item fw-bolder" href="<?= addLink('admin/bookings', 'list') ?>">Liste</a>
                </div>
            </div>
        </div>
<?php endif; ?>

<!-- connexion -->
        <?php else: ?>
        <button type="button" class="btn btn-outline-warning">
            <a class="nav-link mt-0 fw-semibold" href="<?= addLink("users", "login") ?>">connexion
                <i class="fa fa-sign-in fa-2xl"></i>
            </a>
        <?php endif ?>
        </button>

<!-- access aux services  -->
        <button type="button" class="btn btn-outline-warning">
            <a class="nav-link link-light fw-semibold" href="<?= addLink("home","serviceDuGite") ?>">Nos Services
            </a>
        </button>

<!-- inscription -->
        <button type="button" class="btn btn-outline-warning">
            <a class="nav-link link-light fw-semibold" href="<?= addLink("users","newUsers") ?>">Inscription</a>
        </button>

<!-- présentation des propriétaire -->
        <button type="button" class="btn btn-outline-warning ">
            <a class="nav-link link-light fw-semibold" href="<?= addLink("home","aboutUs") ?>">à propos de nous</a>
        </button>
    </nav>
</div>






























<!-- ##########  classic navbar  ############################## -->

    <!-- <a class="navbar-brand" href="<?= addLink("home") ?>">
        </a>     
        <div class="collapse navbar-collapse"  id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">         
                <li class="nav-item">
                    <a class="nav-link active link-warning fw-bolder ms-md-4 me-md-3 fa-baht-sign fs-4" aria-current="page" href="<?= addLink("home") ?>">Accueil
                    </a>
                </li> -->
<!-- connexion avec le message Bienvenue suivi du nom -->
                <!-- <?php
                if( $user = Session::getConnectedUser() ): 
                    ?>
                    <li class="nav-item">
                        <a class="nav-link me-md-3"
                        href="<?= addLink("users", "show", $user->getId_user()) ?>">
                        <?php echo '<p class="last_name bg-success fw-medium m-lg-1 lead">Bienvenue ' . $user->getLast_name() . '</p>';?>
                        </a>
                    </li> -->
    
    <!-- déconnexion -->
                    <!-- <li class="nav-item active mt-2">
                        <a class="nav-link" href="<?= addLink("users", "deco") ?>">
                            <i class="fa fa-sign-out me-md-3  fa-2xl"></i>
                        </a>
                    </li> -->
                    
    <!-- connexion de l'admin et acces de tous ses avantages -->
                    <!-- <?php if( Service\Session::isAdmin() ): ?>
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
                    <?php endif; ?> -->
    
    <!-- connexion -->
                    <!-- <?php else: ?>
                    <li class="nav-item active">
                        <a class="nav-link mt-1" href="<?= addLink("users", "login") ?>">
                            <i class="fa fa-sign-in me-md-3  fa-2xl"></i>
                        </a>
                    </li>
                    <?php endif ?> -->
    
    <!-- access aux services  -->
                    <!-- <li class="nav-item">
                        <a class="nav-link link-warning fw-bolder ms-md-4 me-md-3 fs-4" href="<?= addLink("home","serviceDuGite") ?>">Nos Services</a>
                    </li>
                     -->
    <!-- inscription -->
                    <!-- <li class="nav-item">
                        <a class="nav-link link-warning fw-bolder ms-md-4 me-md-3 fs-4" href="<?= addLink("users","newUsers") ?>">S'inscrire</a>
                    </li> -->
    
    <!-- présentation des propriétaire -->
                    <!-- <li class="nav-item">
                        <a class="nav-link link-warning fw-bolder ms-md-4 me-md-3 fs-4" href="<?= addLink("home","aboutUs") ?>">à propos de nous</a>
                    </li>
                </ul>
            </div> -->
<!--  ########################################################  -->
<!-- panier pour site e-commerce -->
<!-- <li class="nav-item active mt-2 lead lh-1">
        <a class="nav-link" href="<?= addLink("cart", "show") ?>">
        <div class="ensemble d-flex">
            <i class="fa fa-shopping-cart"></i>                  
            <div class="num container fa" id="nombre"><?= $_SESSION["nombre"] ?? ''; ?>
            </div>
            
        </div>
        </a>
    </li> -->

