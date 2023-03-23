<h3>Liste des enseignements</h3>
<br>
<form action="" method="post">
    Filtrer par :
    <input type="text" name="mot">
    <input type="submit" name="Filtrer" value="Filtrer">
</form>
<br>
<br>
<table border="1">
    <tr>
        <td>ID</td>
        <td>Matière</td>
        <td>Nombre d'heures</td>
        <td>Coefficient</td>
        <td>ID Classe</td>
        <td>ID Professeur</td>
    </tr>
<?php
foreach ($lesEnseignements as $unEnseignement) {
    echo"<tr>";
    echo"<td>".$unEnseignement['idenseignement']."</td>";
    echo"<td>".$unEnseignement['matiere']."</td>";
    echo"<td>".$unEnseignement['nbheures']."</td>";
    echo"<td>".$unEnseignement['coef']."</td>";
    echo"<td>".$unEnseignement['idclasse']."</td>";
    echo"<td>".$unEnseignement['idprofesseur']."</td>";
    echo"</tr>";
}
?>
</table>