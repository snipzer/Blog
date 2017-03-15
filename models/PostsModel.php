<?php
namespace Blog\Models;
// Model pour la table Posts
use Blog\Framework\Exceptions;
use Blog\Framework\Models;

class PostsModel
{

    // Get all post
    public static function getAll()
    {
        $sql = '
                select blog.posts.idPosts as id, creationDatePosts as date,  titlePosts as titre, contentPosts as contenu, nameUsers as Auteur, count(blog.comments.idPosts) as NombreCommentaire 
                from blog.posts 
                inner join blog.users on blog.posts.idUsers = blog.users.idUsers
                left join blog.comments on blog.posts.idPosts = blog.comments.idPosts
                group by blog.posts.idPosts
                order by blog.posts.idPosts DESC';

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

    // Get 1 post and the author of the post with the ID
    public static function getById(int $idPosts)
    {
        $sql = '
              select idPosts as id,titlePosts as titre, creationDatePosts as date,  contentPosts as contenu, nameUsers as auteur 
              from blog.posts
              inner join blog.users on blog.posts.idUsers = blog.users.idUsers
              where idPosts = :idPosts';


            $request = Models\ConnectionModel::getInstance()->prepare($sql);
            $request->bindParam(":idPosts", $idPosts, \PDO::PARAM_INT);
            $request->execute();

            if($request->rowCount() != 0)
            {
                $response = $request->fetch(\PDO::FETCH_OBJ);
                return $response;
            }
            else
            {
                throw new Exceptions\NotFoundException("Page not found");
            }

    }
}
?>