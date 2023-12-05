<?php
require "inc/init.inc.php";

$controller = $_GET["controller"] ?? "home";
$method     = $_GET["method"] ?? "list";
$id         = $_GET["id"] ?? null;

// Instancier le contrôleur
$classController = "Controller\\" . ucfirst($controller) . "Controller";

try {
    $controller = new $classController;
    // $playerController->update($id);

    $controller->$method($id);
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
}