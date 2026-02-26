<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Oeuvres</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include('connexion.php'); ?>
    <?php include('menu.php'); ?>

    <div class="container mt-5">
        <h2>Liste des Oeuvres</h2>

    <?php if(isset($_GET['success'])): ?>
        <div class="alert alert-success">Opération réussie!</div>
    <?php endif; ?>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Oeuvre</th>
                <th>Année</th>
                <th>Artiste</th>
                <th>Catégorie</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT o.idoeuvre, o.nom, o.annee, 
                           CONCAT(a.nom, ' ', a.prenom) as artiste, c.nomcategorie as categorie
                    FROM oeuvre o
                    LEFT JOIN artiste a ON o.idartistes = a.idartistes
                    LEFT JOIN categorie c ON o.idcategorie = c.idcategorie
                    ORDER BY o.idoeuvre DESC";
            $resultat = mysqli_query($connexion, $sql);

            while ($oeuvre = mysqli_fetch_assoc($resultat)) :
            ?>
            <tr>
                <td><?= $oeuvre['idoeuvre'] ?></td>
                <td><?= $oeuvre['nom'] ?></td>
                <td><?= $oeuvre['annee'] ?></td>
                <td><?= $oeuvre['artiste'] ?></td>
                <td><?= $oeuvre['categorie'] ?></td>
                <td>
                    <a href="modifier.php?id=<?= $oeuvre['idoeuvre'] ?>" class="btn btn-warning btn-sm">Modifier</a>
                    <a href="supprimer.php?id=<?= $oeuvre['idoeuvre'] ?>" class="btn btn-danger btn-sm"
                       onclick="return confirm('Êtes-vous sûr?')">
                       Supprimer
                    </a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    </div>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>