<?php
require('../include/function.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout d'un nouvel objet</title>
    <link href="../assets/bootstrap-5.3.5-dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="../assets/bootstrap-5.3.5-dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../assets/css/Ajout.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Ajout d'un nouvel objet</h1>
        <div class="form-container">
            <form action="../traitements/trait_AjoutObjet.php" method="post">
                <div class="mb-3">
                    <label for="newObject" class="form-label">Nom de l'objet</label>
                    <input type="text" class="form-control" id="newObject" name="newObject" required>
                </div>

                <div class="mb-3">
                    <label for="categorie" class="form-label">Catégorie</label>
                    <input type="text" class="form-control" id="categorie" name="categorie" required>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </div>
            
            </form>
            
        </div>

        <a href="../src/liste_objet.php" class="btn btn-secondary">Retour a la liste</a>

    </div>
</body>
</html>