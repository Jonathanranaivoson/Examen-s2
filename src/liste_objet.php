<?php
require_once('../include/function.php');
require_once('../include/connexion.php');

$connect = dbconnect();
if (!$connect) {
    die("Erreur de connexion à la base de données.");
}
$object_emprunt = getObjetsWithEmprunts($connect);
mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="fr">
<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des objets</title>
    <link rel="stylesheet" href="../assets/bootstrap-icons/font/bootstrap-icons.css">
    <link href="../assets/bootstrap-5.3.5-dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="../assets/bootstrap-5.3.5-dist/js/bootstrap.bundle.min.js"></script>
    <link href="../assets/css/listeObjet.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-white shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">GG site</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="../Page/profil.php" title="Profil"><i class="bi bi-person-circle"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../src/AjoutObjet.php" title="Uploader"><i class="bi bi-plus-square"></i></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Filtre</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Esthétique</a></li>
                        <li><a class="dropdown-item" href="#">Bricolage</a></li>
                        <li><a class="dropdown-item" href="#">Mécanique</a></li>
                        <li><a class="dropdown-item" href="#">Cuisine</a></li>
                    </ul>
                </li>
            </ul>
            <form class="d-flex align-items-center" role="search">
                <input class="form-control me-2" type="search" placeholder="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
            <div class="nav-item ms-2">
                <a class="nav-link text-danger" href="deconnect.php" title="Se déconnecter"><i class="bi bi-box-arrow-right"></i></a>
            </div>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <h1>Liste des objets</h1>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nom de l'objet</th>
                    <th>Catégorie</th>
                    <th>Propriétaire</th>
                    <th>Statut</th>
                    <th>Date d'emprunt</th>
                    <th>Date de retour</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($object_emprunt as $row): ?>
                <tr>
                    <td><a href="../src/fiche_objet.php?id=<?= $row['id_objet'] ?>" class="text-decoration-none"><?= htmlspecialchars($row['id_objet']) ?></a></td>
                    <td><a href="../src/fiche_objet.php?id=<?= $row['id_objet'] ?>" class="text-decoration-none"><?= htmlspecialchars($row['nom_objet']) ?></a></td>
                    <td><?= htmlspecialchars($row['nom_categorie'] ?? 'N/A') ?></td>
                    <td>
                        <a href="../src/fiche_membre.php?id=<?= $row['id_membre'] ?>" class="text-decoration-none">
                            <?= htmlspecialchars($row['nom_membre'] ?? 'N/A') ?>
                        </a>
                    </td>
                    <td>
                        <?php if ($row['id_emprunt'] && is_null($row['date_retour'])): ?>
                            <span class="badge bg-warning">Emprunté</span>
                        <?php else: ?>
                            <span class="badge bg-success">Disponible</span>
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($row['date_emprunt'] ?? '--') ?></td>
                    <td><?= htmlspecialchars($row['date_retour'] ?? 'Non retourné') ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
