<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="../Assets/css/inscrire.css">

</head>
<body>
    <?php
        if (isset($_GET['error'])) {
            echo "<p style='color: red;'>Un ou plusieur de vos informations sont incorrect.</p>";
        }
    ?>

    <form action="../traitements/trait_inscription.php" method="post">
        <h4>S'INSCRIRE</h4>    
        
        <p>Votre Nom</p>
        <input type="text" name="nom" required>

        <p>Votre Email</p>
        <input type="email" name="email" required>

        <p>Votre Mot de passe</p>
        <input type="password" name="mdp" required>

        <p><input type="submit" value="S'inscrire"></p>
    </form>
</body>
</html>
