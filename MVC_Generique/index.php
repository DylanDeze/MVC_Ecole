<?php 
session_start();
require_once("controleur/config_bdd.php");
require_once("controleur/controleur.class.php");
// Instancier ma classe Contrôleur
$unControleur = new Controleur($serveur, $bdd, $user, $mdp); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scolarité IRIS</title>
</head>
<body>
<center>
    <h1>Gestion de la scolarité IRIS</h1>
    <?php
    if (! isset($_SESSION['email'])) {
        require_once("vue/vue_connexion.php");
    }
        if(isset($_POST['seConnecter']))
        {
            $email = $_POST['email'];
            $mdp = $_POST['mdp'];

            // HACHAGE EN MD5
            // $mdp = md5($mdp);

            // HACHAGE EN SHA1
            // $mdp = sha1($mdp);

            // HACHAGE AVEC UN GRAIN DE SEL
            $unControleur->setTable("grainSel");
            $resultat = $unControleur->selectAll();
            $nb = $resultat[0]['nb'];
            $mdp = $mdp.$nb ;
            $mdp = sha1($mdp);

            $unUser = $unControleur->verifConnexion($email, $mdp);
            if ($unUser == null) {
                echo "<br> Vérifiez vos identifiants";
            } else {
                $today = date ("Y-m-d");
                $dtmdp = $unUser['datemdp'];
                $debut = new DateTime ($today);
                $fin = new DateTime ($dtmdp);
                $interval = $debut->diff($fin);
                echo "NB Jours : " .$interval->format("%a jours");

                $_SESSION['iduser'] = $unUser['iduser'];
                $_SESSION['email'] = $unUser['email'];
                $_SESSION['nom'] = $unUser['nom'];
                $_SESSION['prenom'] = $unUser['prenom'];
                $_SESSION['role'] = $unUser['role'];
                
                if ($interval->format("%a") > 20) {
               header("Location: index.php?page=6");
                } else {
               header("Location: index.php?page=0");
                }
            }
        }
    if (isset($_SESSION['email']))
    {
    echo '
        <a href="index.php?page=0">
            <img src="images/home.png" height="100" width="100">
        </a>
        <a href="index.php?page=1">
            <img src="images/classe.png" height="100" width="100">
        </a>
        <a href="index.php?page=2">
            <img src="images/etudiant.png" height="100" width="100">
        </a>
        <a href="index.php?page=3">
            <img src="images/professeur.png" height="100" width="100">
        </a>
        <a href="index.php?page=4">
            <img src="images/enseignement.png" height="100" width="100">
        </a>
        <a href="index.php?page=6">
            <img src="images/profil.png" height="100" width="100">
        </a>
        <a href="index.php?page=5">
            <img src="images/deconnexion.png" height="100" width="100">
        </a>
    ';

    if(isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 0;
    }
    switch ($page) {
        case 0 : require_once("home.php");break;
        case 1 : require_once("classes.php");break;
        case 2 : require_once("etudiants.php");break;
        case 3 : require_once("professeurs.php");break;
        case 4 : require_once("enseignements.php");break;
        case 5 : 
            session_destroy();
            unset($_SESSION['email']);
            header("Location: index.php?page=0");
            break;
        case 6 : require_once("profil.php"); break;
        default : require_once("erreur_404.php"); break;
    }
} // FIN DU IF SESSION
?>
</center>
</body>
</html>
<style>
    a {
        text-decoration: none;
    }
</style>