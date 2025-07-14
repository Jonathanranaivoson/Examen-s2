<?php
    session_start();
    require('../include/connexion.php');
    require('../include/function.php'); 
    $connect = dbconnect();

header('Location: ../src/liste_objet.php');
exit;

?>