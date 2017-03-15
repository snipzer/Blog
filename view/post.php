<article>
    <header>
        <h1 class="titreBillet"><?php echo htmlspecialchars($post->titre); ?></h1>
        <time><?= $post->date ?></time>
    </header>
    <p><?= $post->contenu ?></p>
</article>
<?php foreach ($comments as $comment): ?>
    <article>
        <header>
            <h2 class="titreBillet"><?php echo $comment->auteur ?></h2>
            <time><?= $comment->date ?></time>
        </header>
        <p><?= $comment->Commentaire ?></p>
    </article>
    <hr/>
<?php endforeach; ?>

<form action="post" method="post">
    <p>Auteur:
        <select name="auteur">
            <?php foreach ($users as $user): ?>
                <option value="<?= $user->username ?>"><?= $user->username ?></option>
            <?php endforeach; ?>
        </select>
    </p>
    <p><textarea name="content" cols="30" rows="10"></textarea></p>
    <p><input type="hidden" name="idPost" value="<?php echo $post->id ?>"></p>
    <input type="submit" value="Submit" name="Submit">
</form>


