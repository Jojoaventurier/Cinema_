<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public\css\style.css"/>
    <title><?php echo $titre ?></title>
</head>
<body>
    <nav>
        <ul>
            <li><a href="index.php?action=accueil">Accueil</a></li>
            <li><a href="index.php?action=listeFilms">Films</a></li>
            <li><a href="index.php?action=listeActeurs">Acteurs</a></li>
            <li><a href="index.php?action=listeRealisateurs">Realisateurs</a></li>
            <li><a href="index.php?action=listeGenres">Genres</a></li>
        </ul>
    </nav>

    <div id="wrapper">
        <main>
            <div id="contenu">
                <h1>PDO Cinema</h1>
                <h2><?= $titre_secondaire ?></h2>
                <?= $contenu ?>
            </div>
        </main>
    </div>

    
</body>

<footer><small>Copyright Elan Formation - 2024</small></footer>
</html>