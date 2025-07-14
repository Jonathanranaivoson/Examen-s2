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

function getNomObjet($connect) {
    $sql = "SELECT nom_objet FROM Gobjet";
    $result = mysqli_query($connect, $sql);
    $nom_objet = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $nom_objet[] = $row;
    }
    return $nom_objet;
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


function getMembreByEmail($connect, $email) {
    $sql = "SELECT id_membre FROM Gmembre WHERE email = ?";
    $stmt = mysqli_prepare($connect, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_assoc($result);
}

function getOrCreateCategory($connect, $categorie) {
    $sql = "SELECT id_categorie FROM Gcategorie_objet WHERE nom_categorie = ?";
    $stmt = mysqli_prepare($connect, $sql);
    mysqli_stmt_bind_param($stmt, "s", $categorie);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if ($row = mysqli_fetch_assoc($result)) {
        return $row['id_categorie'];
    }
    
    $sql = "INSERT INTO Gcategorie_objet (nom_categorie) VALUES (?)";
    $stmt = mysqli_prepare($connect, $sql);
    mysqli_stmt_bind_param($stmt, "s", $categorie);
    
    if (mysqli_stmt_execute($stmt)) {
        return mysqli_insert_id($connect);
    }
    
    return false;
}

function insertNewObject($connect, $nom_objet, $id_categorie, $id_membre) {
    $sql = "INSERT INTO Gobjet (nom_objet, id_categorie, id_membre) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($connect, $sql);
    mysqli_stmt_bind_param($stmt, "sii", $nom_objet, $id_categorie, $id_membre);
    return mysqli_stmt_execute($stmt) ? mysqli_insert_id($connect) : false;
}


function getObjectsWithStatus($connect) {
    $sql = "SELECT o.id_objet, o.nom_objet, c.nom_categorie, m.nom AS nom_membre,
                   e.id_emprunt, e.date_emprunt, e.date_retour
            FROM Gobjet o
            LEFT JOIN Gcategorie_objet c ON o.id_categorie = c.id_categorie
            LEFT JOIN Gmembre m ON o.id_membre = m.id_membre
            LEFT JOIN Gemprunt e ON o.id_objet = e.id_objet AND (e.date_retour IS NULL OR e.date_retour = (
                SELECT MAX(date_retour) FROM Gemprunt WHERE id_objet = o.id_objet
            ))";
    $result = mysqli_query($connect, $sql);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function getObjectDetails($connect, $id_objet) {
    $sql = "SELECT o.*, c.nom_categorie, m.nom AS nom_proprietaire,
                   e.date_emprunt, e.date_retour, em.nom AS nom_emprunteur
            FROM Gobjet o
            LEFT JOIN Gcategorie_objet c ON o.id_categorie = c.id_categorie
            LEFT JOIN Gmembre m ON o.id_membre = m.id_membre
            LEFT JOIN Gemprunt e ON o.id_objet = e.id_objet AND e.date_retour IS NULL
            LEFT JOIN Gmembre em ON e.id_membre = em.id_membre
            WHERE o.id_objet = ?";
    $stmt = mysqli_prepare($connect, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id_objet);
    mysqli_stmt_execute($stmt);
    return mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
}

function getObjectImages($connect, $id_objet) {
    $sql = "SELECT nom_image FROM Gimages_objet WHERE id_objet = ?";
    $stmt = mysqli_prepare($connect, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id_objet);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}



?>






