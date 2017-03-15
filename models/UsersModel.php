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


        $request = Models\ConnectionModel::getInstance()->prepare($sql);
        $request->execute();


        if($request->rowCount() != 0)
        {
            $response = $request->fetchAll(\PDO::FETCH_OBJ);
            return $response;
        }
        else
        {
            throw new Exceptions\NotFoundException("Page not found");
        }
    }


    public static function getUser(int $idUsers)
    {
        $sql = '
              select idUsers as id, nameUsers as username 
              from blog.users
              where idUsers = :idUsers';


        $request = Models\ConnectionModel::getInstance()->prepare($sql);
        $request->bindParam(":idUsers", $idUsers, \PDO::PARAM_INT);
        $request->execute();


        if($request->rowCount() != 0)
        {
            $response = $request->fetchAll(\PDO::FETCH_OBJ);
            return $response;
        }
        else
        {
            throw new Exceptions\NotFoundException("Page not found");
        }
    }
}
?>