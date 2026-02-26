<?php
include 'connexion.php';

// Récupération des données actuelles de l'oeuvre
if (isset($_GET['id'])) {
    $idoeuvre = (int) $_GET['id'];
    $sql = "SELECT o.*, CONCAT(a.nom, ' ', a.prenom) as artiste
            FROM oeuvre o
            LEFT JOIN artiste a ON o.idartistes = a.idartistes
            WHERE o.idoeuvre = $idoeuvre";
    $resultat = mysqli_query($connexion, $sql);
    $oeuvre = mysqli_fetch_assoc($resultat);
    
    if (!$oeuvre) {
        die("Oeuvre non trouvée");
    }
} else {
    die("ID non fourni");
}

// Récupérer les artistes
$sql_artistes = "SELECT idartistes, CONCAT(nom, ' ', prenom) as artiste FROM artiste ORDER BY nom";
$resultat_artistes = mysqli_query($connexion, $sql_artistes);

// Récupérer les catégories
$sql_categories = "SELECT idcategorie, nomcategorie FROM categorie ORDER BY nomcategorie";
$resultat_categories = mysqli_query($connexion, $sql_categories);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier une Oeuvre</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body class="bg-light">
    <?php include 'menu.php'; ?>

    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-warning text-dark">
                <h3>Modifier les informations de l'oeuvre</h3>
            </div>
            <div class="card-body">
                <form action="tr_modifier_oeuvre.php" method="POST">
                    <input type="hidden" name="idoeuvre" value="<?php echo $oeuvre['idoeuvre']; ?>">
                    
                    <div class="mb-3">
                        <label class="form-label">Nom de l'oeuvre</label>
                        <input type="text" name="nom" class="form-control" value="<?php echo $oeuvre['nom']; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Année</label>
                        <input type="number" name="annee" class="form-control" value="<?php echo $oeuvre['annee']; ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Artiste</label>
                        <select name="idartistes" class="form-control">
                            <option value="">-- Choisir un artiste --</option>
                            <?php 
                            while ($art = mysqli_fetch_assoc($resultat_artistes)): 
                            ?>
                                <option value="<?php echo $art['idartistes']; ?>" <?php echo ($art['idartistes'] == $oeuvre['idartistes']) ? 'selected' : ''; ?>>
                                    <?php echo $art['artiste']; ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Catégorie</label>
                        <select name="idcategorie" class="form-control" required>
                            <option value="">-- Choisir une catégorie --</option>
                            <?php 
                            while ($cat = mysqli_fetch_assoc($resultat_categories)): 
                            ?>
                                <option value="<?php echo $cat['idcategorie']; ?>" <?php echo ($cat['idcategorie'] == $oeuvre['idcategorie']) ? 'selected' : ''; ?>>
                                    <?php echo $cat['nomcategorie']; ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success w-100">Enregistrer les modifications</button>
                    <a href="index.php" class="btn btn-secondary w-100 mt-2">Annuler</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
