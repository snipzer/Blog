<?php
namespace Blog\Controllers;
use Blog\Framework\Vue;
// Classe qui va gérer l'affichage de la page Home
class ErrorControl
{
    // Fonction qui va permettre d'envoyer une erreur
    public static function sendError(\Exception $e)
    {
        $msgErreur = $e->getMessage();
        file_put_contents('log/error.log', date('c').$msgErreur."\n", FILE_APPEND);

        $tab = [
            'msgErreur' => $e->getMessage()." Code d'erreur:".$e->getCode()
        ];


        $errorView = new Vue\Vue("error", "Page d'erreur");
        $errorView->generer($tab);
    }
}
?>