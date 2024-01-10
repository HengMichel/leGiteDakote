<?php

// require "../inc/init.inc.php";
// $h1 = "ERREUR 403 : Accès refusé";
$h1 = "ERREUR 403 : Accès refusé";
include __DIR__ . "/../public/header.html.php";
?>

<h2>⛔ Vous n'avez pas accès à cet URL</h2>
<!-- 
<a href="/" class="btn btn-primary">
    <i class="fa fa-home"></i> Retourner à la page d'accueil
</a> -->
<a href="<?= ROOT ?>" class="btn btn-primary">
    <i class="fa fa-home"></i> Retourner à la page d'accueil
</a>

<?php
include __DIR__ . "/../public/footer.html.php";