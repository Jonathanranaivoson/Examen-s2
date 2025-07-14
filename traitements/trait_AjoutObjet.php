<?php
session_start();
require('../include/connexion.php');
require('../include/function.php'); 
$connect = dbconnect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom_objet = trim($_POST['newObject']);
    $categorie = trim($_POST['categorie']);

    if (!empty($nom_objet) && !empty($categorie)) {
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

        $id_categorie = getOrCreateCategory($connect, $categorie);
        if (!$id_categorie) {
            $_SESSION['error'] = "Erreur création catégorie";
            header('Location: ../src/AjoutObjet.php');
            exit;
        }

        $new_id = insertNewObject($connect, $nom_objet, $id_categorie, $membre['id_membre']);
        
        if ($new_id) {
            $_SESSION['success'] = "Objet #$new_id ajouté avec succès";
            header('Location: ../src/liste_objet.php');
            exit;
        } else {
            $_SESSION['error'] = "Erreur lors de l'ajout: " . mysqli_error($connect);
        }
    } else {
        $_SESSION['error'] = "Tous les champs sont obligatoires";
    }
}

header('Location: ../src/AjoutObjet.php');
exit;
?>