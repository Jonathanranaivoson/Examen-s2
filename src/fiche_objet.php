<?php
require_once('../include/connexion.php');
require_once('../include/function.php');

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: liste_objet.php?error=invalid_id');
    exit;
}

$connect = dbconnect();
$id_objet = intval($_GET['id']);
$objet = getObjectDetails($connect, $id_objet);
$images = getObjectImages($connect, $id_objet);

if (!$objet) {
    header('Location: liste_objet.php?error=object_not_found');
    exit;
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Fiche de l'objet <?= htmlspecialchars($objet['nom_objet']) ?></title>
    <link href="../assets/bootstrap-5.3.5-dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h2><?= htmlspecialchars($objet['nom_objet']) ?></h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <strong>ID:</strong> <?= $objet['id_objet'] ?>
                            </li>
                            <li class="list-group-item">
                                <strong>Catégorie:</strong> <?= htmlspecialchars($objet['nom_categorie']) ?>
                            </li>
                            <li class="list-group-item">
                                <strong>Propriétaire:</strong> <?= htmlspecialchars($objet['nom_proprietaire']) ?>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <strong>Statut:</strong>
                                <?php if (!empty($objet['date_emprunt']) && empty($objet['date_retour'])): ?>
                                    <span class="badge bg-warning">Emprunté par <?= htmlspecialchars($objet['nom_emprunteur']) ?></span>
                                <?php else: ?>
                                    <span class="badge bg-success">Disponible</span>
                                <?php endif; ?>
                            </li>
                            <?php if (!empty($objet['date_emprunt'])): ?>
                                <li class="list-group-item">
                                    <strong>Date emprunt:</strong> <?= htmlspecialchars($objet['date_emprunt']) ?>
                                </li>
                            <?php endif; ?>
                            <?php if (!empty($objet['date_retour'])): ?>
                                <li class="list-group-item">
                                    <strong>Date retour:</strong> <?= htmlspecialchars($objet['date_retour']) ?>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
                
                <div class="mt-4">
                    <h4>Images</h4>
                    <?php
                    $sql_images = "SELECT nom_image FROM Gimages_objet WHERE id_objet = ?";
                    $stmt = mysqli_prepare($connect, $sql_images);
                    mysqli_stmt_bind_param($stmt, "i", $id_objet);
                    mysqli_stmt_execute($stmt);
                    $images = mysqli_stmt_get_result($stmt);
                    
                    if (mysqli_num_rows($images) > 0): ?>
                        <div class="d-flex flex-wrap gap-2">
                            <?php while ($image = mysqli_fetch_assoc($images)): ?>
                                <img src="../uploads/<?= htmlspecialchars($image['nom_image']) ?>" 
                                     alt="Image de <?= htmlspecialchars($objet['nom_objet']) ?>" 
                                     class="img-thumbnail" style="width: 200px; height: 200px; object-fit: cover;">
                            <?php endwhile; ?>
                        </div>
                    <?php else: ?>
                        <p class="text-muted">Aucune image disponible</p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="card-footer">
                <a href="../src/liste_objet.php" class="btn btn-secondary">Retour à la liste</a>
                
                <?php if (empty($objet['date_emprunt']) || !empty($objet['date_retour'])): ?>
                    <a href="../src/emprunt.php?id=<?= $objet['id_objet'] ?>" class="btn btn-primary">Emprunter</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>