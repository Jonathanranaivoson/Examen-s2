<?php
  session_start();
  require('../include/connexion.php');
  $connect = dbconnect();

        $email = $_POST['email'];
        $mdp = $_POST['mdp'];

        $sql = "SELECT email, mdp FROM Gmembre WHERE email ='$email' AND mdp ='$mdp'";
        $resultat = mysqli_query($connect, $sql);

    if($donnee = mysqli_fetch_assoc($resultat)){

        if (mysqli_query($connect, $sql)) {
            $_SESSION['email'] = $donnee['email'];
                header('Location: ../src/liste_objet.php');
                exit;
        } else {
            echo "Email ou Mot de Passe incorrect , Veuillez Reesayer";
        }
    }else{
        echo "Utilisateur inexistante ou pas dans la base de donnee .";
    }
?>