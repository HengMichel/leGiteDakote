<?php

/* ⚠ Il faut inclure le fichier autoload AVANT d'exécuter la fonction session_start() sinon il y aura
une error si on essaye de stocker un objet dans la variable superglobale $_SESSION */

include __DIR__ . "/functions.inc.php";
define("ROOT", "/leGiteDakote/");
define("ROLE_USER", 10);
define("ROLE_ADMIN", 50);
require "autoload.php";
session_start();