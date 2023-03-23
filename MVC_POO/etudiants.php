<h2>Gestion des étudiants</h2>

<?php
    if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
        $lesClasses = $unControleur->selectAllClasses();
        $lEtudiant = null;
        if (isset($_GET['action']) && isset($_GET['idetudiant']))
        {
            $action = $_GET['action'];
            $idetudiant = $_GET['idetudiant'];
            switch($action){
                case "edit" : $lEtudiant = $unControleur->selectWhereEtudiant($idetudiant); 
                // var_dump($lEtudiant);
                break;
                case "sup" : $unControleur->deleteEtudiant ($idetudiant); break;
            }
        }
        require_once("vue/vue_insert_etudiant.php");

        if(isset($_POST['Valider']))
        {
            $unControleur->insertEtudiant($_POST);
        }
        if(isset($_POST['Modifier']))
        {
            $unControleur->updateEtudiant($_POST);
            header("Location: index.php?page=2");
        }
    }
    
    if(isset($_POST['Filtrer'])) {
        $mot = $_POST['mot'];
        $lesEtudiants = $unControleur->selectLikeEtudiants($mot);
    } else {
        $lesEtudiants = $unControleur->selectAllEtudiants();
    }
    require_once("vue/vue_les_etudiants.php");
    echo "<br> Le nombre d'étudiants est de : ".$unControleur->count("etudiant")['nb'];
?>