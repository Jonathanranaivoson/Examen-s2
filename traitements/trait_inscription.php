<?php
  session_start();
  require('../include/connexion.php');
  $connect = dbconnect();

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $nom = $_POST['nom'];
        $email = $_POST['email'];
        $mdp = $_POST['mdp'];

        $check = "SELECT * FROM membre WHERE nom = '$nom' AND email = '$email' AND mdp = '$mdp'";
        $verify_check = mysqli_query($connect, $check);

          if(mysqli_num_rows($verify_check) > 0){
                echo "L'Utilisateur existe deja";
            }else{

            $sql = "INSERT INTO membre (nom, email, mdp) VALUES ('$nom', '$email', '$mdp')";

            if (mysqli_query($connect, $sql)) {
                $_SESSION['email'] = $email;
                var_dump($_SESSION['email']);
                
                header('Location: ../src/accueil.php');
                exit;
            } else {
                echo "Erreur lors de l'inscription: " . mysqli_error($connect);
            }
        }
    }
?>