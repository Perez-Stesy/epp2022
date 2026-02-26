<?php
$serveur = "localhost";
$utilisateur = "root";
$motdepasse = "";
$base = "tresorbd";

$connexion = mysqli_connect($serveur, $utilisateur, $motdepasse, $base);

if (!$connexion) {
    die("Connexion échouée: " . mysqli_connect_error());
}
?>