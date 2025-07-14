<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link href="../assets/bootstrap-5.3.5-dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="../assets/bootstrap-5.3.5-dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../assets/css/log.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <?php
            if (isset($_GET['error'])) {
                echo "<p class='error-message text-danger'>Email ou mot de passe incorrect.</p>";
            }
            ?>

            <form action="../traitements/trait_login.php" method="post">
                <h4>CONNEXION</h4>

                <div class="mb-3">
                    <label for="email" class="form-label">Votre Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <div class="mb-3">
                    <label for="mdp" class="form-label">Votre Mot de passe</label>
                    <input type="password" class="form-control" id="mdp" name="mdp" required>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Se connecter</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>