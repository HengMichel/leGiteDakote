<?php
function addLink($controller, $method = "list", $id = null)
{
     // return ROOT . "?controller=$controller&method=$method" . ($id ? "&id=$id" : "");
    //  return ROOT . "$controller/$method" . ($id ? "/$id" : "");
     
    // ***************  modif ***********************
      // Récupère le protocole (http ou https)
      $protocol = empty($_SERVER['HTTPS']) ? 'http' : 'https';

      // Récupère le nom du serveur et le chemin de base de l'URL
      $basePath = $protocol . '://' . $_SERVER['HTTP_HOST'] . "/projetMvc/";

      // Retourne le lien complet en utilisant le chemin de base
      return $basePath . "$controller/$method" . ($id ? "/$id" : "");
    // ********************************************************************

   
}


function debug($var)
{
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
}

function d_die($var)
{
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
    die;
}

function redirection($url)
{
    header("Location: $url");
    exit;
}

// ⚠ test
function error($num = 404)
{
    include "error/$num.php";
    exit;
}