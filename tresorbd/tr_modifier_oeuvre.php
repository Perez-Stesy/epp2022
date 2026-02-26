<?php
include 'connexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idoeuvre = (int) $_POST['idoeuvre'];
    $nom = mysqli_real_escape_string($connexion, $_POST['nom']);
    $annee = !empty($_POST['annee']) ? (int) $_POST['annee'] : NULL;
    $idartistes = !empty($_POST['idartistes']) ? (int) $_POST['idartistes'] : NULL;
    $idcategorie = (int) $_POST['idcategorie'];

    // Formater les valeurs NULL pour SQL
    $annee_val = ($annee !== NULL) ? $annee : 'NULL';
    $idartistes_val = ($idartistes !== NULL) ? $idartistes : 'NULL';

    $sql = "UPDATE oeuvre SET nom = '$nom', 
            annee = $annee_val, idartistes = $idartistes_val, idcategorie = $idcategorie 
            WHERE idoeuvre = $idoeuvre";
    
    $resultat = mysqli_query($connexion, $sql);

    if ($resultat) {
        header("Location: index.php?success=1");
    } else {
        header("Location: modifier.php?id=$idoeuvre&error=1");
    }
} else {
    header("Location: index.php");
}
?>
