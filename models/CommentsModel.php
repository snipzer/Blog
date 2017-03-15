<?php
namespace Blog\Models;

use Blog\Classes\Exceptions;

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

        $request = ConnectionModel::getInstance()->prepare($sql);
        $request->execute();

        if ($request->rowCount() != 0)
        {
            $response = $request->fetchAll(\PDO::FETCH_OBJ);
            return $response;
        }
        else
        {
            throw new Exceptions\NotFoundException("Page not found");
        }

    }

    // Get all comment for a post
    public static function getByPostId(int $idPosts)
    {
        $sql = '
              SELECT idComments AS id, creationDateComments AS date,  contentComments AS Commentaire, authorComments AS auteur 
              FROM blog.comments
              WHERE blog.comments.idPosts = :idPosts
              ORDER BY creationDateComments DESC';

        $request = ConnectionModel::getInstance()->prepare($sql);
        $request->bindParam(":idPosts", $idPosts, \PDO::PARAM_INT);
        $request->execute();
        $response = $request->fetchAll(\PDO::FETCH_OBJ);
        return $response;

    }

    //Get one comment with his id
    public static function getById(int $idComments)
    {
        $sql = '
              SELECT idComments AS id, creationDateComments AS date,  contentComments AS Commentaire, authorComments AS auteur 
              FROM blog.comments
              WHERE idComments = :idComments';

        $request = ConnectionModel::getInstance()->prepare($sql);
        $request->bindParam(":idComments", $idComments, \PDO::PARAM_INT);
        $request->execute();

        if ($request->rowCount() != 0)
        {
            $response = $request->fetchAll(\PDO::FETCH_OBJ);
            return $response;
        }
        else
        {
            throw new Exceptions\NotFoundException("Page not found");
        }
    }

    public static function postCommentByIdPost($auteur, $content, int $idPost)
    {
        $sql = 'INSERT INTO blog.comments(creationDateComments, authorComments, contentComments, idPosts) VALUES (NOW(), :auteur, :content, :idPost)';

        $request = ConnectionModel::getInstance()->prepare($sql);

        $request->bindParam(":auteur", $auteur, \PDO::PARAM_STR);
        $request->bindParam(":content", $content, \PDO::PARAM_STR);
        $request->bindParam(":idPost", $idPost, \PDO::PARAM_INT);

        $request->execute();
    }
}

?>