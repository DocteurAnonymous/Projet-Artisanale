<?php
require_once __DIR__ . "/../../Config/db.php";

require_once __DIR__ . "/../../Backend/Produit/produit.php";

$pdo = connectionDB();
$produit = new Produits($pdo);

$liste = $produit->GetProduits();

?>






<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Gestion Produits | ArtisanShop Admin</title>

    <!-- Bootstrap -->
    <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/fontawesome.css">
    <link rel="stylesheet" href="../../assets/css/templatemo-villa-agency.css">

    <style>
        .card-img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 6px;
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
                <h3>Gestion des Produits</h3>
                <span class="breadcrumb">Dashboard / Produits</span>
            </div>
        </div>
    </div>
</div>

<!-- ===== Section : Formulaire d'ajout ===== -->
<div class="section py-5">
    <div class="container">
        <div class="row">

            <!-- Liste des produits -->
            <div class="col-lg-12">
                <div class="section-heading mb-1">
                    <h6>| Produits enregistrés</h6>
                    <h2>Liste</h2>
                    <a href="ajout_produit.php" class="btn btn-primary mb-0">Ajouter un nouveau produit</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Nom</th>
                                <th>Catégorie</th>
                                <th>Prix</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($liste as $key => $produit):?>
                            <tr>
                                <td><img src="../../assets/images/Produits/<?= $produit['image'] ?>" class="card-img" alt="<?= $produit['nom'] ?>"></td>
                                <td><?= $produit['nom'] ?></td>
                                <td><?= $produit['categorie'] ?></td>
                                <td><?= $produit['prix'] ?> GNF</td>
                                <td><?= $produit['description'] ?></td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="modifier_produit.php?id=<?= $produit['id'] ?>" 
                                        class="btn btn-sm btn-warning">
                                            Modifier
                                        </a>

                                        <button class="btn btn-sm btn-danger" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#supprimerModal<?= $produit['id'] ?>">
                                            Supprimer
                                        </button>
                                    </div>

                                    <!-- Modal de confirmation -->
                                    <div class="modal fade" id="supprimerModal<?= $produit['id'] ?>" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <h5 class="modal-title text-danger">Confirmer la suppression</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>

                                                <div class="modal-body">
                                                    Cette action est <strong>irréversible</strong>.  
                                                    Voulez-vous vraiment supprimer ce produit ?
                                                </div>

                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                    <a href="supprimer_produit.php?id=<?= $produit['id'] ?>" 
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
</div>

<!-- ===== Footer ===== -->
    <?php require_once __DIR__ . "/../../footer.php"; ?>




</body>
</html>
