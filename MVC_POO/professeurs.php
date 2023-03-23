<h2>Gestion des professeurs</h2>

<?php
    require_once("vue/vue_insert_professeur.php");
    if(isset($_POST['Valider']))
    {
        $unControleur->insertProfesseur($_POST);
    }
    if(isset($_POST['Filtrer'])) {
        $mot = $_POST['mot'];
        $lesProfesseurs = $unControleur->selectLikeProfesseurs($mot);
    } else {
        $lesProfesseurs = $unControleur->selectAllProfesseurs();
    }
    require_once("vue/vue_les_professeurs.php");

    echo "<br> Le nombre de professeurs est de : ".$unControleur->count("professeur")['nb'];
?>