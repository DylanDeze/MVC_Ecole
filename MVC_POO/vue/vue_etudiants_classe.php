<table border="1">
    <tr>
        <td>ID Etudiant</td>
        <td>Nom</td>
        <td>Prénom</td>
        <td>Mail</td>
    </tr>
<?php
foreach ($lesEtudiants as $unEtudiant) {
    echo"<tr>";
    echo"<td>".$unEtudiant['idetudiant']."</td>";
    echo"<td>".$unEtudiant['nom']."</td>";
    echo"<td>".$unEtudiant['prenom']."</td>";
    echo"<td>".$unEtudiant['email']."</td>";
    echo"</tr>";
    }

?>
</table>