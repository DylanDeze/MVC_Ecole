<h2>Gestion des enseignements</h2>

<?php
    $lesClasses = $unControleur->selectAllClasses();
    $lesProfesseurs = $unControleur->selectAllProfesseurs();
    require_once("vue/vue_insert_enseignement.php");
    if(isset($_POST['Valider']))
    {
        $unControleur->insertEnseignement($_POST);
    }
    if(isset($_POST['Filtrer'])) {
        $mot = $_POST['mot'];
        $lesEnseignements = $unControleur->selectLikeEnseignements($mot);
    } else {
        $lesEnseignements = $unControleur->selectAllEnseignements();
    }
    require_once("vue/vue_les_enseignements.php");

    echo "<br> Le nombre d'enseignements est de : ".$unControleur->count("enseignement")['nb'];
?>