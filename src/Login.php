<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link href="../assets/bootstrap-5.3.5-dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="../assets/bootstrap-5.3.5-dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../Assets/css/login.css">

</head>
<body>

    <?php
    if (isset($_GET['error'])) {
        echo "<p style='color: red;'>Email ou mot de passe incorrect.</p>";
    }
    ?>

    <form action="../traitements/trait_login.php" method="post">
        <h4>LOGIN</h4>
        
        <p>Votre email</p>
        <input type="email" name="email" required>

        <p>Votre Mot de passe</p>
        <input type="password" name="mdp" required>
        
        <p><input type="submit" value="login"></p>
    </form>
</body>
</html>
