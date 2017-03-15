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
                SELECT blog.posts.idPosts AS id, creationDatePosts AS date,  titlePosts AS titre, contentPosts AS contenu, nameUsers AS Auteur, count(blog.comments.idPosts) AS NombreCommentaire 
                FROM blog.posts 
                INNER JOIN blog.users ON blog.posts.idUsers = blog.users.idUsers
                LEFT JOIN blog.comments ON blog.posts.idPosts = blog.comments.idPosts
                GROUP BY blog.posts.idPosts
                ORDER BY blog.posts.idPosts DESC';

        $request = Models\ConnectionModel::getInstance();
        $response = $request->query($sql);
        if(sizeof($response) == 0)
        {
            throw new Exceptions\NotFoundException("Page not found");
        }
        return $response;
    }

    // Get 1 post and the author of the post with the ID
    public static function getById(int $idPosts)
    {
        $sql = '
              SELECT idPosts AS id,titlePosts AS titre, creationDatePosts AS date,  contentPosts AS contenu, nameUsers AS auteur 
              FROM blog.posts
              INNER JOIN blog.users ON blog.posts.idUsers = blog.users.idUsers
              WHERE idPosts = :idPosts';


        $request = Models\ConnectionModel::getInstance();
        $response = $request->query($sql, [":idPosts" => $idPosts]);


        if(sizeof($response) == 0)
        {
            throw new Exceptions\NotFoundException("Page not found");
        }
        return $response[0];

    }
}

?>