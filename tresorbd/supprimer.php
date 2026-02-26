<?php
include 'connexion.php';

// Récupération sécurisée de l'ID passé en paramètre GET
$idoeuvre = (int) $_GET['id'];

if ($idoeuvre > 0) {
    $requete = "DELETE FROM oeuvre WHERE idoeuvre = $idoeuvre";
    $execution = mysqli_query($connexion, $requete);

    if ($execution) {
        header("Location: index.php?success=1");
        exit();
    } else {
        echo "Erreur lors de la suppression : " . mysqli_error($connexion);
    }
} else {
    echo "ID de l'oeuvre invalide.";
}
?>
