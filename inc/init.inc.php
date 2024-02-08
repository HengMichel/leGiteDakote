<?php

/* ⚠ Il faut inclure le fichier autoload AVANT d'exécuter la fonction session_start() sinon il y aura
une error si on essaye de stocker un objet dans la variable superglobale $_SESSION */

require "autoload.php";
session_start();
include __DIR__ . "/functions.inc.php";
define("ROOT", "/leGiteDakote/");

define("ROLE_USER", "ROLE_USER");
define("ROLE_ADMIN", "ROLE_ADMIN"); 
define("INSERTED", "Enregistrer"); 
define("UPDATED", "Modifier"); 
define("DELETED", "Spprimer"); 
define("UPLOAD_CHAMBRES_IMG", "uploads/chambres/");
