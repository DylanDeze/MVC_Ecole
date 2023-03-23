<h2>Ecole IRIS</h2>
<br>
<?php 
    echo "Bonjour, ".$_SESSION['nom']. " ".$_SESSION['prenom'];
    echo "<br> Vous avez le rôle : ".$_SESSION['role'];
    echo "<br><br>";
    $unControleur->setTable("classesEtudiants");
    $lesResultats = $unControleur->selectAll();
    require_once("vue/vue_classes_groupees.php");
?>
<br>
<img src="images/iris.png" width="700" height="500" alt="">
<br>
<br>
<a href="https://ecoleiris.fr">Rejoignez-nous</a>