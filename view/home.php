<?php foreach ($billets as $billet): ?>
    <article>
        <header>
            <h1 class="titreBillet"><a href="post/<?php echo $billet->id; ?>"><?php echo htmlspecialchars($billet->titre); ?></a></h1>
            <time><?= $billet->date ?></time><p><?= $billet->NombreCommentaire ?></p>
        </header>
        <p><?= $billet->contenu ?></p>
    </article>
    <hr/>
<?php endforeach; ?>

