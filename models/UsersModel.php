<?php
namespace Blog\Models;
use Blog\Framework\Exceptions;
use Blog\Framework\Models;

// Model pour la classe Users
class UsersModel
{

    // Renvois tout les utilisateurs
    public static function getUsers()
    {
        $sql = '
              select idUsers as id, nameUsers as username 
              from blog.users 
              order by idUsers desc';

        $request = new Models\ConnectionModel();
        $response = $request->query($sql);

        if(sizeof($response) == 0)
        {
            throw new Exceptions\NotFoundException("Page not found");
        }
        return $response;
    }


    public static function getUser(int $idUsers)
    {
        $sql = '
              select idUsers as id, nameUsers as username 
              from blog.users
              where idUsers = :idUsers';

        $request = new Models\ConnectionModel();
        $response = $request->query($sql, ["isUsers" => $idUsers]);
        if(sizeof($response) == 0)
        {
            throw new Exceptions\NotFoundException("Page not found");
        }
        return $response;
    }
}
?>