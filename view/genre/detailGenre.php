<?php ob_start(); 
 $libelleGenre = $requeteGenre->fetch(); 
?>



<h2><?=

 $libelleGenre["libelle"]; ?></h2>


<table>
    <thead>
        <tr>
            <th>Titre</th>
            <th>Année de sortie FR</th>
            <th>Réalisateur</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($requete->fetchAll() as $film) { ?>
                <tr>
                    <td><?= $film["titre"] ?></td>
                    <td><?= $film["sortie"] ?></td>
                    <td><?= $film["prenom"] ?></td>
                    <td><?= $film["nom"] ?></td>
                </tr>
        <?php } ?>
    </tbody>
</table>

<?php
$titre = "Liste des films pour le genre " . $libelleGenre["libelle"];
$titre_secondaire = "Liste des films pour le genre" . $libelleGenre["libelle"];
$contenu = ob_get_clean();
require "view/template.php";