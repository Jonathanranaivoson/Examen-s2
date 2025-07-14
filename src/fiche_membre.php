<?php
require_once('../include/connexion.php');
require_once('../include/function.php');

$connect = dbconnect();
if (!$connect) {
    die("Erreur de connexion à la base de données.");
}

$id_membre = $_GET['id'] ?? null;
if (!$id_membre) {
    die("Membre non spécifié.");
}

$sql = "SELECT o.nom_objet, c.nom_categorie, e.date_emprunt, e.date_retour
        FROM Gobjet o
        LEFT JOIN Gcategorie_objet c ON o.id_categorie = c.id_categorie
        LEFT JOIN Gemprunt e ON o.id_objet = e.id_objet AND e.id_membre = ?
        WHERE o.id_membre = ? OR e.id_membre = ?";
$stmt = mysqli_prepare($connect, $sql);
mysqli_stmt_bind_param($stmt, "iii", $id_membre, $id_membre, $id_membre);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$objets = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Objets du membre</title>
    <link href="../assets/bootstrap-5.3.5-dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Objets associés au membre n°<?= htmlspecialchars($id_membre) ?></h2>
    <a href="javascript:history.back()" class="btn btn-secondary mb-3">← Retour</a>
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>Nom de l'objet</th>
                <th>Catégorie</th>
                <th>Date d'emprunt</th>
                <th>Date de retour</th>
            </tr>
        </thead>
        <tbody>
        <?php if (count($objets) > 0): ?>
            <?php foreach ($objets as $obj): ?>
                <tr>
                    <td><?= htmlspecialchars($obj['nom_objet']) ?></td>
                    <td><?= htmlspecialchars($obj['nom_categorie'] ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($obj['date_emprunt'] ?? '--') ?></td>
                    <td><?= htmlspecialchars($obj['date_retour'] ?? 'Non retourné') ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="4" class="text-center">Aucun objet trouvé.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>
