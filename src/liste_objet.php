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
    <link href="../assets/bootstrap-5.3.5-dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="../assets/bootstrap-5.3.5-dist/js/bootstrap.bundle.min.js"></script>
    <link href="../assets/css/listeObjet.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">GG site</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="AjoutObjet.php">Ajouter un nouvel objet</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Filtre
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Esthetique</a></li>
            <li><a class="dropdown-item" href="#">Bricolage</a></li>
            <li><a class="dropdown-item" href="#">Mecanique</a></li>
            <li><a class="dropdown-item" href="#">Cuisine</a></li>
          </ul>
        </li>
     
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>

    </div>
  </div>
</nav>


    <div class="container">
        <h1>Liste des objets</h1>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nom de l'objet</th>
                        <th scope="col">Categorie</th>
                        <th scope="col">Proprietaire</th>
                        <th scope="col">Statut</th>
                        <th scope="col">Date d'emprunt</th>
                        <th scope="col">Date de retour</th>
                    </tr>
                </thead>
                <tbody>
                        <?php foreach ($object_emprunt as $row): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['id_objet']); ?></td>
                                <td><?php echo htmlspecialchars($row['nom_objet']); ?></td>
                                <td><?php echo htmlspecialchars($row['nom_categorie'] ?? 'N/A'); ?></td>
                                <td><?php echo htmlspecialchars($row['nom_membre'] ?? 'N/A'); ?></td>
                                <td>
                                    <?php
                                    if ($row['id_emprunt'] && is_null($row['date_retour'])) {
                                        echo '<span class="badge bg-warning">Emprunté</span>';
                                    } else {
                                        echo '<span class="badge bg-success">Disponible</span>';
                                    }
                                    ?>
                                </td>
                                <td><?php echo htmlspecialchars($row['date_emprunt'] ?? '--'); ?></td>
                                <td><?php echo htmlspecialchars($row['date_retour'] ?? 'Non retourné'); ?></td>
                            </tr>
                        <?php endforeach; ?>
    
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>