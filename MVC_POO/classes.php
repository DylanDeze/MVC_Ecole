<h2>Gestion des classes </h2>

<?php 
    if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin')
    {
        $laClasse = null;
        $lesEtudiants = null;
        if (isset($_GET['action']) && isset($_GET['idclasse']))
        {
            $action = $_GET['action'];
            $idclasse = $_GET['idclasse'];
            switch($action){
                case "edit" : $laClasse = $unControleur->selectWhereClasse($idclasse); 
                // var_dump($laClasse);
                break;
                case "sup" : $unControleur->deleteClasse ($idclasse); break;
                case "voir" : $lesEtudiants = $unControleur->selectEtudiantsClasse($idclasse); break;
            }
        }
        require_once("vue/vue_insert_classe.php");

        if(isset($_POST['Valider']))
        {
            $unControleur->insertClasse($_POST);
        }
        if(isset($_POST['Modifier']))
        {
            $unControleur->updateClasse($_POST);
            header("Location: index.php?page=1");
        }
    }
    if(isset($_POST['Filtrer'])) {
        $mot = $_POST['mot'];
        $lesClasses = $unControleur->selectLikeClasses($mot);
    } else {
        $lesClasses = $unControleur->selectAllClasses();
    }
    require_once("vue/vue_les_classes.php");
    echo "<br> Le nombre de classes est de : ".$unControleur->count("classe")['nb'];
    echo "<br> <br>";

    if ($lesEtudiants != null) {
        $laClasse = $unControleur->selectWhereClasse($idclasse);
        echo "<br>Liste des étudiants de la classe : ".$laClasse['nom']."<br>";
        require_once("vue/vue_etudiants_classe.php");
    } else 
    {
        echo"<br> Aucun étudiant n'est affecté à cette classe !";
    }
?>