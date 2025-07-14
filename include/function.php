<?php
require_once('connexion.php');

function getUserByEmail($connect, $email) {
    $sql = "SELECT * FROM Gmembre WHERE email = ?";
    $stmt = mysqli_prepare($connect, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    return mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
}



?>