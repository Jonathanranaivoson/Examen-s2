<?php
  session_start();
  require('../include/connexion.php');
  $connect = dbconnect();

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $nom = $_POST['nom'];
        $email = $_POST['email'];
        $ddn = $_POST['ddn'];
        $genre = $_POST['genre'];
        $ville = $_POST['ville'];
        $mdp = $_POST['mdp'];

        $check = "SELECT * FROM Gmembre WHERE nom = '$nom' AND email = '$email' AND ddn ='$ddn' AND genre = '$genre' AND ville = '$ville' AND mdp = '$mdp'";
        $verify_check = mysqli_query($connect, $check);

          if(mysqli_num_rows($verify_check) > 0){
                echo "L'Utilisateur existe deja";
            }else{

            $sql = "INSERT INTO Gmembre (nom, email, ddn, genre, ville, mdp) VALUES ('$nom', '$email','$ddn','$genre','$ville', '$mdp')";

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