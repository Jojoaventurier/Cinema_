<?php ob_start(); 
?>

<p>
    <a class='link bouton' href="index.php?action=afficherFormulaireRole">AJOUTER UN ROLE A LA BASE DE DONNEE</a>
</p>

<!-- Formulaire pour ajouter une association FILM-ACTEUR-RÔLE (table casting de la BDD) -->
<form action="index.php?action=ajouterNouveauCasting" method="post">

        <!-- Choisir le film  -->
        <label for="film">Film :</label><br>
        <select name="film" id="film">    
                <?php
                    // alimenter la liste déroulante avec les films
                    foreach($requeteListeFilms->fetchAll() as $film) {
                        echo '<option value="'. $film["id_film"].'">' . $film["titre"].'</option>';
                    }
                ?>
        </select><br>

         <!-- Choisir l'acteur ou l'actrice -->           
        <label for="acteur">Acteur ou actrice :</label><br>
        <select name="acteur" id="acteur">    
                <?php
                    // alimenter la liste déroulante avec les acteur.trices
                    foreach($requeteListeActeurs->fetchAll() as $acteur) {
                        echo '<option value="'. $acteur["id_acteur"].'">' . $acteur['acteur'].'</option>';
                    }
                ?>
        </select><br>

        <!-- Choisir le rôle (présent en BDD)  -->
        <label for="role">Rôle :</label><br>
        <select name="role" id="role">    
                <?php
                    // alimenter la liste déroulante avec les rôles
                    foreach($requeteListeRoles->fetchAll() as $role) {
                        echo '<option value="'. $role["id_role"].'">' . $role['nomRole'].'</option>';
                    }
                ?>
        </select><br>

        
        <input type='submit' name='submit'>
</form>


<?php
    $titre = "Ajouter un acteur ou actrice au casting d'un film";
    $titre_secondaire = "Ajouter un acteur ou une actrice au casting d'un film";
    $contenu = ob_get_clean();
    require "template.php";
?>