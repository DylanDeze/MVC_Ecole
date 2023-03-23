<h3>Ajout d'un enseignement</h3>
<form method="post">
    <table>
    <tr>
            <td>Nom de la matière</td>
            <td><input type="text" name="matiere"></td>
        </tr>
        <tr>
            <td>NB Heures</td>
            <td><input type="text" name="nbheures"></td>
        </tr>
        <tr>
            <td>Coéfficient</td>
            <td><input type="text" name="coef"></td>
        </tr>
        <tr>
        <td>Classe</td>
            <td>
                <select name="idclasse">
                    <?php 
                    foreach ($lesClasses as $uneClasse) {
                        echo"<option value='".$uneClasse['idclasse']."'>";
                        echo $uneClasse['nom'];
                        echo "</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
        <td>Professeur</td>
            <td>
                <select name="idprofesseur">
                    <?php 
                    foreach ($lesProfesseurs as $unProfesseur) {
                        echo"<option value='".$unProfesseur['idprofesseur']."'>";
                        echo $unProfesseur['nom'];
                        echo "</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <td><input type="reset" name="Annuler" value="Annuler"></td>
        <td><input type="submit" name="Valider" value="Valider"></td>
    </table>
</form>