<?php
namespace Blog\Classes;

class AutoLoad
{
    public static function autoload()
    {
        spl_autoload_register(function ($class) {

            // Premier caractère du namespace à retirer
            $class = str_replace('Blog\\', '', $class);
            // Changer les \ par des /
            $class = str_replace('\\', '/', $class);


            // Récupère la première partie du chemin pour la mettre en minuscule
            $strFinal = preg_replace_callback('#^(.+/)([^/]+)$#', function($match)
            {
                return strtolower($match[1]) . $match[2];
            }, $class);

            include BASE_DIR . "$strFinal.php";

        });
    }
}
?>