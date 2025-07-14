<?php
require_once('../include/connexion.php');
require_once('../include/function.php');


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../assets/bootstrap-5.3.5-dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="../assets/bootstrap-5.3.5-dist/js/bootstrap.bundle.min.js"></script>
    <title>Emprunter</title>
</head>
<body>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Formulaire d'emprunt</h1>
        <div class="form-container">
            <form action="../traitements/trait_AjoutObjet.php" method="post">
                <div class="mb-3">
                    <label for="date_emprunt" class="form-label">Date d'emprunt</label>
                    <input type="date" class="form-control" name="date_emprunt" required>
                </div>

                 <div class="mb-3">
                    <label for="date_retour" class="form-label">date de retour</label>
                    <input type="date" class="form-control" name="date_retour" required>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Valider</button>
                </div>
            
            </form>
            
        </div>

        <a href="../src/liste_objet.php" class="btn btn-secondary">Retour a la liste</a>

    </div>

</body>
</html>