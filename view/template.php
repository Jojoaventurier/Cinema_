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
            <li><a href="index.php?action=listeFilms.php">Films</a></li>
            <li><a href="listeActeurs.php">Acteurs</a></li>
            <li><a href="listeRealisateurs.php">Realisateurs</a></li>
            <li><a href="listeGenres.php">Genres</a></li>
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
</html>