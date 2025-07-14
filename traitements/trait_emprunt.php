<?php
session_start();
require('../include/connexion.php');
require('../include/function.php'); 
$connect = dbconnect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $date_emprunt = $_POST['date_emprunt'];
    $date_retour = $_POST['date_retour'];

    if (!empty($date_emprunt) && !empty($date_retour)) {
        if (!isset($_SESSION['email'])) {
            $_SESSION['error'] = "Veuillez vous connecter";
            header('Location: ../src/login.php');
            exit;
        }

        $membre = getMembreByEmail($connect, $_SESSION['email']);
        if (!$membre) {
            $_SESSION['error'] = "Profil non trouvé";
            header('Location: ../src/AjoutObjet.php');
            exit;
        }

        $new_id = insertDatEmprunt($connect,  $date_emprunt, $date_retour, $membre['id_membre']);
        
        if ($new_id) {
            $_SESSION['success'] = "Objet #$new_id empruntee ";
            header('Location: ../src/liste_objet.php');
            exit;
        } else {
            $_SESSION['error'] = "Erreur lors de l'ajout: " . mysqli_error($connect);
        }
    } else {
        $_SESSION['error'] = "Tous les champs sont obligatoires";
    }
}

header('Location: ../src/liste_objet.php');
exit;
?>