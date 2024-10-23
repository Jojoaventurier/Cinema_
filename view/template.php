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
        <ul> <!-- navigation vers les différentes section du site -->
            <li><a class="navLink" href="index.php?action=accueil">ACCUEIL</a></li>
            <li><a class="navLink" href="index.php?action=listeFilms">FILMS</a></li>
            <li><a class="navLink" href="index.php?action=listeActeurs">ACTEURS</a></li>
            <li><a class="navLink" href="index.php?action=listeRealisateurs">REALISATEURS</a></li>
            <li><a class="navLink" href="index.php?action=listeGenres">GENRES</a></li>
        </ul>
    </nav>
    <div id="wrapper">
        <main>
            <div id="contenu">
                <h1>Le Ciné de Geoff</h1>
                <h2><?= $titre_secondaire ?></h2>
                <?= $contenu ?> <!-- Contenu qui s'adapte à la page selon les views demandées par les méthodes du controleur -->
            </div>
        </main>
    </div>
</body>

<footer><small>Copyright Elan Formation - 2024</small></footer>
</html>