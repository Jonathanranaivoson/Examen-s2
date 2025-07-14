<?php
require_once('connexion.php');

function getUserByEmail($connect, $email) {
    $sql = "SELECT * FROM Gmembre WHERE email = ?";
    $stmt = mysqli_prepare($connect, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    return mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
}

function getCategories($connect) {
    $sql = "SELECT * FROM Gcategorie_objet";
    $result = mysqli_query($connect, $sql);
    $categories = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $categories[] = $row;
    }
    return $categories;
}

function getObjects($connect) {
    $sql = "SELECT o.id_objet, o.nom_objet, o.id_categorie, o.id_membre, m.nom AS nom_membre 
            FROM Gobjet o 
            LEFT JOIN Gmembre m ON o.id_membre = m.id_membre";
    $result = mysqli_query($connect, $sql);
    $objects = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $objects[] = $row;
    }
    return $objects;
}


function getEmprunts($connect) {
    $sql = "SELECT e.id_emprunt, e.id_objet, e.id_membre, e.date_emprunt, e.date_retour, 
                   o.nom_objet, m.nom AS nom_membre
            FROM Gemprunt e
            LEFT JOIN Gobjet o ON e.id_objet = o.id_objet
            LEFT JOIN Gmembre m ON e.id_membre = m.id_membre";
    $result = mysqli_query($connect, $sql);
    if (!$result) {
        return [];
    }
    $emprunts = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $emprunts[] = $row;
    }
    return $emprunts;
}


function getObjetsWithEmprunts($connect) {
    $sql = "SELECT * FROM VueObjets";
    $result = mysqli_query($connect, $sql);
    if (!$result) {
        return [];
    }
    $objects = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $objects[] = $row;
    }
    return $objects;
}



?>

