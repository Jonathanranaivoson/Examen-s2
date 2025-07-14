<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link href="../assets/bootstrap-5.3.5-dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/insc.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <?php
            if (isset($_GET['error'])) {
                echo "<p class='error-message text-danger'>Un ou plusieurs de vos informations sont incorrects.</p>";
            }
            ?>

            <form action="../traitements/trait_inscription.php" method="post">
                <h4>S'INSCRIRE</h4>

                <div class="mb-3">
                    <label for="nom" class="form-label">Votre Nom</label>
                    <input type="text" class="form-control" id="nom" name="nom" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Votre Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <div class="mb-3">
                    <label for="ddn" class="form-label">Votre Date de naissance</label>
                    <input type="date" class="form-control" id="ddn" name="ddn" required>
                </div>

                <div class="mb-3">
                    <label for="genre" class="form-label">Genre</label>
                    <select class="form-select" id="genre" name="genre" required>
                        <option value="" disabled selected>Sélectionnez votre genre</option>
                        <option value="Homme">Homme</option>
                        <option value="Femme">Femme</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="ville" class="form-label">Ville</label>
                    <input type="text" class="form-control" id="ville" name="ville">
                </div>

                <div class="mb-3">
                    <label for="mdp" class="form-label">Votre Mot de passe</label>
                    <input type="password" class="form-control" id="mdp" name="mdp" required>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">S'inscrire</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>