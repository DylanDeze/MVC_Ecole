<table border="1">
    <tr>
        <td>Nom de la classe</td>
        <td>Salle de cours</td>
        <td>Nombre d'étudiants</td>
    </tr>
<?php
foreach ($lesResultats as $unResultat) {
    echo"<tr>";
    echo"<td>".$unResultat['nom']."</td>";
    echo"<td>".$unResultat['salle']."</td>";
    echo"<td>".$unResultat['nb']."</td>";
    echo"</tr>";    
}
?>
</table>