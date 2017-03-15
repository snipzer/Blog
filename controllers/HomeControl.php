<?php
namespace Blog\Controllers;
use Blog\Models;
use Blog\Classes;
// Classe qui va gérer l'affichage de la page Home
class HomeControl
{


    public static function sendHome()
    {
        // Initialisation d'un tableau de paramètre
        $tab = [
            'billets' => Models\PostsModel::getAll()
        ];

        // Préparation de la page Home
        $home = new Classes\Vue("home", "Accueil blog");
        // Chargement et envois du tableau de données sur la page
        $home->generer($tab);
    }
}
?>