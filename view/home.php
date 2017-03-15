<?php foreach ($billets as $billet): ?>
    <article>
        <header>
            <h1 class="titreBillet"><a href="post/<?php echo $billet->id; ?>"><?php echo nl2br(htmlspecialchars($billet->titre)); ?></a></h1>
            <time><?= $billet->date ?></time><p><?= $billet->NombreCommentaire ?></p>
        </header>
        <p><?= nl2br(htmlentities($billet->contenu)) ?></p>
    </article>
    <hr/>
<?php endforeach; ?>

