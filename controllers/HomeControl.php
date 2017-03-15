<?php
namespace Blog\Controllers;
use Blog\Models;
use Blog\Framework\Vue;
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
        $home = new Vue\Vue("home", "Accueil blog");
        // Chargement et envois du tableau de données sur la page
        $home->generer($tab);
    }
}
?>