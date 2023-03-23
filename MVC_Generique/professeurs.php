<h2>Gestion des professeurs</h2>

<?php
$unControleur->setTable("professeur");  
    require_once("vue/vue_insert_professeur.php");
    if(isset($_POST['Valider']))
    {
        $tab = array("nom"=>$_POST['nom'],
                    "prenom"=>$_POST['prenom'],
                    "diplome"=>$_POST['diplome']);
        $unControleur->insert($tab);
    }
    if(isset($_POST['Filtrer'])) {
        $mot = $_POST['mot'];
        $tab = array("nom", "prenom", "diplome");
        $lesProfesseurs = $unControleur->selectLike($mot, $tab);
    } else {
        $lesProfesseurs = $unControleur->selectAll();
    }
    require_once("vue/vue_les_professeurs.php");

    echo "<br> Le nombre de professeurs est de : ".$unControleur->count("professeur")['nb'];
?>