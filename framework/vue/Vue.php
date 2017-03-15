<?php
namespace Blog\Framework\Vue;
use Blog\Framework\Configuration;
//Classe qui va gérer les vues
class Vue
{
    // Nom de la vue
    private $fichier;
    // Titre de la page
    private $title;
    private $layoutName;

    public function __construct($action, $titre, $layoutName = "layout")
    {
        $this->fichier = "view/" . $action . ".php";
        $this->title = $titre;
        $this->layoutName = $layoutName;
    }

    // Génère et affiche la vue
    public function generer($donnees)
    {
        $contenu = $this->genererFichier($this->fichier, $donnees);

        $racineWeb = Configuration\Configuration::get('view', 'RACINE_WEB');
        $vue = $this->genererFichier('view/'.$this->layoutName.'.php', array('title' => $this->title, 'contenu' => $contenu, 'racineWeb' => $racineWeb));

        echo $vue;
    }

    // Génère un fichier vue et renvoie le résultat produit
    private function genererFichier($fichier, $donnees)
    {
        if (file_exists($fichier))
        {
            // Transforme un tableau associatif en variable
            extract($donnees);

            ob_start();
            require $fichier;
            return ob_get_clean();
        }
        else
        {
            throw new \Exception("Fichier '$fichier' introuvable");
        }
    }
}
?>