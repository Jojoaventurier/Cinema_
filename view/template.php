<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/css/style.css">
    <title><?php echo $titre ?></title>
</head>
<body>
    <nav>
        <ul>
            <li>Accueil</li>
            <li>Films</li>
            <li>Acteurs</li>
            <li>Realisateurs</li>
            <li>Genres</li>
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