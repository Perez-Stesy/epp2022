<?php
include 'connexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifier que les champs requis sont présents (nom et catégorie)
    if (empty($_POST['nom']) || empty($_POST['idcategorie'])) {
        header("Location: ajouter_oeuvre.php?error=1");
        exit();
    }

    $nom = mysqli_real_escape_string($connexion, $_POST['nom']);
    $annee = !empty($_POST['annee']) ? (int) $_POST['annee'] : NULL;
    $idartistes = !empty($_POST['idartistes']) ? (int) $_POST['idartistes'] : NULL;
    $idcategorie = (int) $_POST['idcategorie'];

    // Formater les valeurs NULL pour SQL
    $annee_val = ($annee !== NULL) ? $annee : 'NULL';
    $idartistes_val = ($idartistes !== NULL) ? $idartistes : 'NULL';

    $sql = "INSERT INTO oeuvre (nom, descripion, annee, idartistes, idcategorie) 
            VALUES ('$nom', '', $annee_val, $idartistes_val, $idcategorie)";
    
    $resultat = mysqli_query($connexion, $sql);

    if ($resultat) {
        header("Location: ajouter_oeuvre.php?success=1");
    } else {
        header("Location: ajouter_oeuvre.php?error=1");
    }
} else {
    header("Location: ajouter_oeuvre.php");
}
?>
