<h3>Mon Profil</h3>
<br>
<h4>Nom : <?= $_SESSION['nom'] ?></h4>
<h4>Prénom : <?= $_SESSION['prenom'] ?></h4>
<h4>Votre mail : <?= $_SESSION['email'] ?></h4>
<h4>Votre rôle : <?= $_SESSION['role'] ?></h4>

<form method="post">
    New Mot de passe : <br>
    <input type="password" name="mdp"><br>
    <input type="submit" name="ChangerMdp" value="New MDP">
</form>

<?php 
if (isset($_POST['ChangerMdp']))
{
    $mdp = $_POST['mdp'];

    // HACHAGE AVEC UN GRAIN DE SEL
    $unControleur->setTable("grainSel");
    $resultat = $unControleur->selectAll();
    $nb = $resultat[0]['nb'];
    $mdph = $mdp.$nb ;
    $mdph = sha1($mdp);

    // Recherche dans la table historique
    $unControleur->setTable("historique");
    $unResultat = $unControleur->selectWhere("mdp", $mdph);
    // var_dump($unResultat);
    if ($unResultat == null) {
        echo"<br> Modification réussie";
        $unControleur->setTable("user");
        $dt = date("Y-m-d");
        $tab = array("nom"=>$_SESSION['nom'],
                        "prenom"=> $_SESSION['prenom'],
                        "email"=>$_SESSION['email'],
                        "mdp"=>$mdp,
                        "role"=>$_SESSION['role'],
                        "datemdp"=>$dt, 
                        "actif"=>"1");
            $unControleur->update($tab, "iduser", $_SESSION['iduser']);
    } else {
        echo"<br> Vous devez prendre un new MDP";
    }
}
?>