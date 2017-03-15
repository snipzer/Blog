<?php
namespace Blog\Controllers;

use Blog\Framework\Exceptions;

// Contrôleur de controleur
class Routeur
{

    // Fonction qui va gérer les appels de controleurs
    public static function pageHandler($action)
    {
        try
        {
            switch ($action)
            {
                case "home":
                    HomeControl::sendHome();
                    break;

                case "post":
                    if (isset($_POST['submit']))
                    {
                        PostControl::newComment();
                    }
                    PostControl::sendPost();
                    break;

                default:
                    throw new Exceptions\NotFoundException("Page not found");
            }
        }
        catch (Exceptions\NotFoundException $e)
        {
            ErrorControl::sendError($e);
        }
    }
}
?>