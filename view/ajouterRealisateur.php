<?php ob_start(); ?>

    <form action="index.php?action=ajouterNouveauRealisateur" method="post">
        <label for="nom">Nom :</label><br>
            <input required="required" type="text" id="nom" name="nom" /><br>

        <label for="prenom">Prénom :</label><br>
            <input required="required" type="text" id="prenom" name="prenom" /><br>
        
        <!-- choisir la date de naissance-->
        <label for="dateNaissance">Date de naissance:</label><br>
            <input required="required" type="date" id="dateNaissance" name="dateNaissance" min='1895-01-01' max="<?= date('Y-m-d');?>" /><br>
        
        <!--Insérer la biographie (texte) 
        <label for="resume">Biographie :</label><br>
            <textarea id="biographie" name="biographie" rows="4" cols="50"></textarea><br>
        -->
        <!--choisir le sexe -->
        <label for="realisateur">Sexe</label>
            <select name="sexe" id="sexe">
                <?php $el = array( "   ","homme", "femme");

                        alimenterListeDeroulante($el);

                        function alimenterListeDeroulante($array) {
                            foreach($array as $value) {
                            echo '<option value="'.strtolower($value).'">' .$value.'</option>';
                            }
                        }
                ?>
            </select><br>
        <input type="submit" name="submit">
    </form>


<?php
    $titre = "Ajouter un acteur ou une actrice";
    $titre_secondaire = "Ajouter un acteur ou une actrice";
    $contenu = ob_get_clean();
    require "template.php";
?>



