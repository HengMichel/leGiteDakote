<?php

require "../inc/init.inc.php";
$h1 = "ERREUR 404 : La page n'existe pas";
include ROOT . "views/header.html.php";
?>

<h2>🛑 L'URL demandé n'existe pas</h2>

<a href="/" class="btn btn-primary">
    <i class="fa fa-home"></i> Retourner à la page d'accueil
</a>

<?php
include "../views/footer.html.php";