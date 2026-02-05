<?php 

    require_once __DIR__ . "/../../Config/db.php";
    require_once __DIR__ . "/../../Backend/Commande/commande.php";

    $pdo = connectionDB();

    $commandes = new Commandes($pdo);
    $listeCommandes = $commandes->ListeCommande();


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Gestion Commandes | ArtisanShop Admin</title>

    <!-- Bootstrap -->
    <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/fontawesome.css">
    <link rel="stylesheet" href="../../assets/css/templatemo-villa-agency.css">

    <style>
        .table td, .table th {
            vertical-align: middle;
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
                <h3>Gestion des Commandes</h3>
                <span class="breadcrumb">Dashboard / Commandes</span>
            </div>
        </div>
    </div>
</div>

<!-- ===== Section : Liste des commandes ===== -->
<div class="section py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading mb-4">
                    <h6>| Commandes reçues</h6>
                    <h2>Liste complète</h2>
                </div>

                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Nom complet</th>
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th>Produit</th>
                            <th>Description</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($listeCommandes as $key =>$commande) : ?>
                        <tr>
                            <td><?= $key+1; ?></td>
                            <td><?= $commande['nom'] ?></td>
                            <td><?= $commande['email'] ?></td>
                            <td><?= $commande['telephone'] ?></td>
                            <td><?= $commande['nom_produit'] ?></td>
                            <td><?= $commande['description'] ?></td>
                            <td><?= $commande['statut'] ?></td>
                            <td>
                                <!-- Bouton Traiter -->
                                <?php if($commande['statut'] != 'valider'): ?>
                                    <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#traiterModal<?= $commande['id'] ?>">
                                        Valider
                                    </button>
                                <?php endif; ?>

                                <!-- Modal de confirmation de validation -->
                                <div class="modal fade" id="traiterModal<?= $commande['id'] ?>" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h5 class="modal-title">Confirmer le traitement</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <div class="modal-body">
                                                Voulez-vous vraiment <strong>marquer cette commande comme traitée</strong> ?
                                            </div>

                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>

                                                <a href="traiter_commande.php?id=<?= $commande['id'] ?>" 
                                                class="btn btn-success">
                                                Oui, traiter
                                                </a>
                                            </div>

                                        </div>
                                    </div>
                                </div>


                                <!-- Bouton Supprimer -->
                                <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#supprimerModal<?= $commande['id'] ?>">
                                    Supprimer
                                </button>
                                <!-- Modal de confirmation de suppression -->
                                <div class="modal fade" id="supprimerModal<?= $commande['id'] ?>" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h5 class="modal-title text-danger">Confirmer la suppression</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <div class="modal-body">
                                                Cette action est <strong>irréversible</strong>.  
                                                Voulez-vous vraiment supprimer cette commande ?
                                            </div>

                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>

                                                <a href="supprimer_commande.php?id=<?= $commande['id'] ?>" 
                                                class="btn btn-danger">
                                                Oui, supprimer
                                                </a>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </td>

                        </tr>
                        <?php endforeach ?>
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
