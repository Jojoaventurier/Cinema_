<?php ob_start(); ?>


    <!-- Formulaire pour ajouter un nouvel acteur ou une nouvelle actrice à la base de donnée -->
    <form action="index.php?action=ajouterNouvelActeur" method="post">
        <!-- choisir le nom -->
        <label for="nom">Nom :</label><br>
            <input required="required" type="text" id="nom" name="nom" /><br>

        <!-- choisir le prénom -->    
        <label for="prenom">Prénom :</label><br>
            <input required="required" type="text" id="prenom" name="prenom" /><br>
        
        <!-- choisir la date de naissance-->
        <label for="dateNaissance">Date de naissance:</label><br>
            <input required="required" type="date" id="dateNaissance" name="dateNaissance" min='1895-01-01' max="<?= date('Y-m-d');?>" /><br>

        <!--choisir le sexe -->
        <label for="realisateur">Sexe</label>

            <select name="sexe" id="sexe">
                <?php $el = array( "   ","homme", "femme");

                        alimenterListeDeroulante($el);  //fonction pour alimenter la liste déroulante (choix du sexe)
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




  