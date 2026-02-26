<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une oeuvre</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include('connexion.php'); ?>
    <?php include('menu.php'); ?>
    
    <div class="container mt-5">
        <h2>Ajouter une oeuvre</h2>

<?php if(isset($_GET['success'])): ?>
    <div class="alert alert-success">Oeuvre ajoutée!</div>
<?php elseif(isset($_GET['error'])): ?>
    <div class="alert alert-danger">Erreur lors de l'ajout</div>
<?php endif; ?>

<?php
// Récupérer les artistes
$sql_artistes = "SELECT idartistes, CONCAT(nom, ' ', prenom) as artiste FROM artiste ORDER BY nom";
$resultat_artistes = mysqli_query($connexion, $sql_artistes);

// Récupérer les catégories
$sql_categories = "SELECT idcategorie, nomcategorie FROM categorie ORDER BY nomcategorie";
$resultat_categories = mysqli_query($connexion, $sql_categories);
?>

        <form action="tr_ajouter_oeuvre.php" method="POST">
    <div class="mb-3">
        <label>Nom de l'oeuvre:</label>
        <input type="text" name="nom" class="form-control" required>
    
    
    <div class="mb-3">
        <label>Année:</label>
        <input type="number" name="annee" class="form-control" >
    </div>
    <div class="mb-3">
        <label>Artiste</label>
        <select name="idartistes" class="form-control" > 
            <option value="">-- Choisir un artiste --</option>
            <?php while ($art = mysqli_fetch_assoc($resultat_artistes)): ?>
                <option value="<?php echo $art['idartistes']; ?>"><?php echo $art['artiste']; ?></option>
            <?php endwhile; ?>
        </select>
    </div>
    <div class="mb-3">
        <label>Catégorie</label>
        <select name="idcategorie" class="form-control" required>
            <option value="">-- Choisir une catégorie --</option>
            <?php 
            mysqli_data_seek($resultat_categories, 0);
            while ($cat = mysqli_fetch_assoc($resultat_categories)): 
            ?>
                <option value="<?php echo $cat['idcategorie']; ?>"><?php echo $cat['nomcategorie']; ?></option>
            <?php endwhile; ?>
        </select>
    </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </div>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>