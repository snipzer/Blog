<?php
namespace Blog\Models;

use Blog\Framework\Exceptions;
use Blog\Framework\Models;
// Model pour la table Comment
class CommentsModel
{
    // Get all comments
    public static function getAll()
    {
        $sql = '
              SELECT idComments AS id, creationDateComments AS date,  contentComments AS Commentaire, authorComments AS auteur 
              FROM blog.comments 
              ORDER BY idComments ASC';

        $request = new Models\ConnectionModel();
        $response = $request->query($sql);

        if(sizeof($response) == 0)
        {
            throw new Exceptions\NotFoundException("Page not found");
        }

        return $response;
    }

    // Get all comment for a post
    public static function getByPostId(int $idPosts)
    {
        $sql = '
              SELECT idComments AS id, creationDateComments AS date,  contentComments AS Commentaire, authorComments AS auteur 
              FROM blog.comments
              WHERE blog.comments.idPosts = :idPosts
              ORDER BY creationDateComments DESC';

        $request = new Models\ConnectionModel();
        $response = $request->query($sql, [":idPosts" => $idPosts]);

        return $response;
    }

    //Get one comment with his id
    public static function getById(int $idComments)
    {
        $sql = '
              SELECT idComments AS id, creationDateComments AS date,  contentComments AS Commentaire, authorComments AS auteur 
              FROM blog.comments
              WHERE idComments = :idComments';

        $request = new Models\ConnectionModel();
        $response = $request->query($sql, ["idComments" => $idComments]);

        if(sizeof($response) == 0)
        {
            throw new Exceptions\NotFoundException("Page not found");
        }
        return $response;
    }

    public static function postCommentByIdPost($auteur, $content, int $idPost)
    {
        $sql = 'INSERT INTO blog.comments(creationDateComments, authorComments, contentComments, idPosts) VALUES (NOW(), :auteur, :content, :idPost)';

        $params = [
            "auteur" => $auteur,
            "content" => $content,
            "idPost" => $idPost
        ];

        $request = new Models\ConnectionModel();
        $response = $request->execute($sql, $params);

    }
}

?>