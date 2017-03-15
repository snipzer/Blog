<?php
define("BASE_DIR", __DIR__ . "/");
use Blog\Framework\Autoload;
use Blog\Controllers;
require_once "framework/autoload/AutoLoad.php";

// Classe qui va gérer l'autoload des requires
Autoload\AutoLoad::autoload();

if (!isset($_GET['action']) || !ctype_alpha($_GET['action']))
{
    $_GET['action'] = "home";
}

Controllers\Routeur::pageHandler($_GET['action']);
?>
