<?php
define("BASE_DIR", __DIR__ . "/");
use Blog\Classes;
use Blog\Classes\Exceptions;
use Blog\Controllers;

require_once "classes/AutoLoad.php";

// Classe qui va gérer l'autoload des requires
Classes\AutoLoad::autoload();

if (!isset($_GET['action']) || !ctype_alpha($_GET['action']))
{
    $_GET['action'] = "home";
}

Controllers\FrontControl::pageHandler($_GET['action']);
?>
