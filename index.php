<?php
require "inc/init.inc.php";

$admin      = $_GET["doc"] ?? null;
$controller = $_GET["controller"] ?? "home";
$method     = $_GET["method"] ?? "list";
$id         = $_GET["id"] ?? null;

// Instancier le contrôleur
if(!empty($admin)){
    $classController = 
    
    // ucfirst: met la première lettre d'un string en majuscule
    "Controller\\admin\\" . ucfirst($controller) . "Controller";
}else{
    $classController = "Controller\\" . ucfirst($controller) . "Controller";
}

try {
    $controller = new $classController;
    // $playerController->update($id);

    $controller->$method($id);
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
}