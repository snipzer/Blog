<?php
namespace Blog\Controllers;
use Blog\Framework\Exceptions;
use Blog\Framework\Vue;
use \Blog\Models;
// Classe qui controle la page post
class PostControl
{

    // Fonction qui affiche la page
    public static function sendPost()
    {
        // Si pas de valeur de GET id ou que la GET id n'est pas un entier
        if(!isset($_GET['id']) || !ctype_digit($_GET['id']))
        {
            //Envois une erreur Page not found
            throw new Exceptions\NotFoundException("404 error, page not found");
        }

        // Cast de GET id en entier
        $id = (int)$_GET['id'];

        // Préparation du tableau de données
        $tab = [
            // Appel du modèle Posts pour avoir un post par rapport a sont id
            'post' => Models\PostsModel::getById($id),
            // Appel du modèle Comments pour avoir les commentaires correspondant à un post
            'comments' => Models\CommentsModel::getByPostId($id),
            'users' => Models\UsersModel::getAll()
        ];

        // Instanciation d'une Vue(nomDeLaPage, TitreDeLaPage)
        $postVue = new Vue\Vue("post", "Blog affichage d'un post");

        // Envois du tableau de données
        $postVue->generer($tab);
    }

    public static function newComment()
    {

        if(!isset($_POST['idPost']) || !isset($_POST['auteur']) || !isset($_POST['content']))
        {
            throw new Exceptions\NotFoundException("Page not found");
        }
        $post = (int)$_POST['idPost'];
        Models\CommentsModel::postCommentByIdPost($_POST['auteur'], $_POST['content'], $post);

        $tab = [
            'post' => Models\PostsModel::getById($post),
            'comments' => Models\CommentsModel::getByPostId($post),
            'users' => Models\UsersModel::getAll()
        ];

        // Instanciation d'une Vue(nomDeLaPage, TitreDeLaPage)
        $postVue = new Vue\Vue("post", "Blog affichage d'un post");

        // Envois du tableau de données
        $postVue->generer($tab);
    }
}
?>