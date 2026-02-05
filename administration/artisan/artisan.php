<?php
require_once __DIR__ . "/../../Config/db.php";

require_once __DIR__ . "/../../Backend/Artisan/artisan.php";

$pdo = connectionDB();
$artisan = new Artisans($pdo);

$liste = $artisan->Getartisans();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Gestion Artisans | ArtisanShop Admin</title>

    <!-- Bootstrap -->
    <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/fontawesome.css">
    <link rel="stylesheet" href="../../assets/css/templatemo-villa-agency.css">

    <style>
        .card-img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 50%;
        }
        .card-stats {
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

<!-- ===== Header ===== -->
<?php require_once __DIR__ . "/../header.php"; ?>


<!-- ===== Page heading ===== -->
<div class="page-heading header-text">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h3>Gestion des Artisans</h3>
                <span class="breadcrumb">Dashboard / Artisans</span>
            </div>
        </div>
    </div>
</div>

<!-- ===== Section : Formulaire d'ajout ===== -->
<div class="section py-5">
    <div class="container">
        <div class="row">
            <!-- Liste des artisans -->
            <div class="col-lg-12">
                <div class="section-heading">
                    <h6>| Artisans enregistrés</h6>
                    <h2>Liste</h2>
                    <a href="ajout_artisan.php" class="btn btn-primary">Ajouter un artisan</a>
                </div>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Photo</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Adresse</th>
                            <th>Téléphone</th>
                            <th>Métier</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($liste as $key => $artisan):?>
                        <tr>
                            <td><img src="../../assets/images/Artisans/<?= $artisan['image'] ?>" class="card-img" alt="<?= $artisan['nom'] ?>"></td>
                            <td><?= $artisan['nom'] ?></td>
                            <td><?= $artisan['prenom'] ?></td>
                            <td><?= $artisan['adresse'] ?></td>
                            <td><?= $artisan['telephone'] ?></td>
                            <td><?= $artisan['metier'] ?></td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="modifier_artisan.php?id=<?= $artisan['id'] ?>" 
                                    class="btn btn-sm btn-warning">
                                        Modifier
                                    </a>

                                    <button class="btn btn-sm btn-danger" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#supprimerModal<?= $artisan['id'] ?>">
                                        Supprimer
                                    </button>
                                </div>

                                <!-- Modal de confirmation -->
                                <div class="modal fade" id="supprimerModal<?= $artisan['id'] ?>" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h5 class="modal-title text-danger">Confirmer la suppression</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <div class="modal-body">
                                                Cette action est <strong>irréversible</strong>.  
                                                Voulez-vous vraiment supprimer cet artisan ?
                                            </div>

                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                <a href="supprimer_artisan.php?id=<?= $artisan['id'] ?>" 
                                                class="btn btn-danger">
                                                    Oui, supprimer
                                                </a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<!-- ===== Footer ===== -->
    <?php require_once __DIR__ . "/../../footer.php"; ?>


</body>
</html>
