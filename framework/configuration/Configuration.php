<?php
namespace Blog\Framework\Configuration;

class Configuration
{

    private static $parametres;

    // Renvoie la valeur d'un paramètre de configuration
    public static function get($section, $nom)
    {
        if (isset(self::getParametres()[$section][$nom]))
        {
            $valeur = self::getParametres()[$section][$nom];
        }
        else
        {
            $valeur = null;
        }
        return $valeur;
    }

    // Renvoie le tableau des paramètres en le chargeant au besoin
    private static function getParametres()
    {
        if (self::$parametres == null)
        {
            $cheminFichier = "framework/configuration/prod.ini";
            if (!file_exists($cheminFichier))
            {
                $cheminFichier = "framework/configuration/dev.ini";
            }

            if (!file_exists($cheminFichier))
            {
                throw new \Exception("Aucun fichier de configuration trouvé");
            }
            else
            {
                self::$parametres = parse_ini_file($cheminFichier, true);
            }
        }
        return self::$parametres;
    }
}

?>