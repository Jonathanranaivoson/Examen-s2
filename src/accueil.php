<?php
require('../include/function.php');
$categories = getCategories();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des categories</title>
    <link href="../assets/bootstrap-5.3.5-dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="../assets/bootstrap-5.3.5-dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container">
        <h1>Liste des categories</h1>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-white">
                    <tr>
                     
                     <?php
                        foreach ($categories as $row) {
                            echo "<td>" . htmlspecialchars($row['nom_categorie']) . "</td>";                           
                        }
                     ?>
                        
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</body>
</html>