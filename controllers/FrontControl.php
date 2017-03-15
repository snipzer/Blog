<?php
namespace Blog\Controllers;
use Blog\Framework\Exceptions;
// Contrôleur de controleur
class FrontControl
{

    // Fonction qui va gérer les appels de controleurs
    public static function pageHandler($action)
    {
        try
        {
            if($action == "home")
            {
                HomeControl::sendHome();
            }
            else if($action == "post")
            {
                if(isset($_POST['Submit']))
                {
                    PostControl::newComment();
                }
                PostControl::sendPost();
            }
            else
            {
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