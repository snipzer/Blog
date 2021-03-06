<?php
namespace Blog\Models;
use Blog\Framework\Exceptions;
use Blog\Framework\Models;

// Model pour la classe Users
class UsersModel
{

    // Get all user
    public static function getAll()
    {
        $sql = '
              select idUsers as id, nameUsers as username 
              from blog.users 
              order by idUsers desc';

        $request = Models\ConnectionModel::getInstance();
        $response = $request->query($sql);

        if(sizeof($response) == 0)
        {
            throw new Exceptions\NotFoundException("Page not found");
        }
        return $response;
    }

    // Get one user
    public static function getById(int $idUsers)
    {
        $sql = '
              select idUsers as id, nameUsers as username 
              from blog.users
              where idUsers = :idUsers';

        $request = Models\ConnectionModel::getInstance();
        $response = $request->query($sql, ["isUsers" => $idUsers]);
        if(sizeof($response) == 0)
        {
            throw new Exceptions\NotFoundException("Page not found");
        }
        return $response[0];
    }
}
?>