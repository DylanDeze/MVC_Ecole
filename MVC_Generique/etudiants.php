<h2>Gestion des étudiants</h2>

<?php
$unControleur->setTable("etudiant");
    if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
        
        $unControleur->setTable("classe");
        $lesClasses = $unControleur->selectAll();
        $unControleur->setTable("etudiant");
        $lEtudiant = null;
        if (isset($_GET['action']) && isset($_GET['idetudiant']))
        {
            $action = $_GET['action'];
            $idetudiant = $_GET['idetudiant'];
            switch($action){
                case "edit" : $lEtudiant = $unControleur->selectWhere("idetudiant",$idetudiant); 
                // var_dump($lEtudiant);
                break;
                case "sup" : $unControleur->delete ("idetudiant", $idetudiant); break;
            }
        }
        require_once("vue/vue_insert_etudiant.php");

        if(isset($_POST['Valider']))
        {
            $tab = array("nom"=>$_POST['nom'],
                         "prenom"=>$_POST['prenom'],
                         "email"=>$_POST['email'], 
                         "idclasse"=>$_POST['idclasse']);
            $unControleur->insert($tab);
        }
        if(isset($_POST['Modifier']))
        {
            $tab = array("nom"=>$_POST['nom'],
                         "prenom"=>$_POST['prenom'],
                         "email"=>$_POST['email'], 
                         "idclasse"=>$_POST['idclasse']);
            $unControleur->update($tab, "idetudiant",$_POST['idetudiant']);
            header("Location: index.php?page=2");
        }
    }
    
    if(isset($_POST['Filtrer'])) {
        $mot = $_POST['mot'];
        $tab = array("nom", "prenom", "email");
        $lesEtudiants = $unControleur->selectLike($mot, $tab);
    } else {
        $lesEtudiants = $unControleur->selectAll();
    }
    require_once("vue/vue_les_etudiants.php");
    echo "<br> Le nombre d'étudiants est de : ".$unControleur->count("etudiant")['nb'];
?>