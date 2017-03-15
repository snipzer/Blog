<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <base href="<?php echo $racineWeb; ?>" >
    <link rel="stylesheet" href="public/css/style.css"/>
    <title><?php echo $title; ?></title>
</head>
<body>
<div id="global">
    <header>
        <a href="home"><h1 id="titreBlog"><?php echo $title; ?></h1></a>
        <p>Je vous souhaite la bienvenue sur ce modeste blog.</p>
    </header>
    <div id="contenu">
        <?php echo $contenu; ?>
    </div>
    <footer id="piedBlog">
        Blog réalisé avec PHP, HTML5 et CSS.
    </footer>
</div>
</body>
</html>
