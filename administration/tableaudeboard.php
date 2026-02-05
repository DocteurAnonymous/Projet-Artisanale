<?php 

    require_once __DIR__ . "/../Backend/Tableaudebord/dashboard.php";

    // Se connecter a la base de données
    $pdo = connectionDB();


    //Recupérer le nombre d'artisans
    $countArtisans = TotalDesDonnees();


?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard | ArtisanShop Admin</title>

    <!-- Bootstrap -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/fontawesome.css">
    <link rel="stylesheet" href="../assets/css/templatemo-villa-agency.css">

    <style>
        .card-stats {
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }
        .card-stats:hover {
            transform: translateY(-5px);
        }
        .card-stats .icon {
            font-size: 2.5rem;
            color: #ff7f50;
        }
    </style>
</head>
<body>

<?php require_once __DIR__ . "/header.php"; ?>

<!-- ===== Page heading ===== -->
<div class="page-heading header-text">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h3>Tableau de bord</h3>
                <span class="breadcrumb">Accueil / Dashboard</span>
            </div>
        </div>
    </div>
</div>

<!-- ===== Statistiques ===== -->
<div class="section py-5">
    <div class="container">
        <div class="row g-4">

            <!-- Nombre d’artisans -->
            <div class="col-lg-3 col-md-6">
                <div class="card card-stats text-center p-4">
                    <div class="icon mb-2"><i class="fa fa-user fa-2x"></i></div>
                    <h5>Artisans</h5>
                    <h3><?= $countArtisans['totalArtisans'] ?></h3>
                </div>
            </div>

            <!-- Nombre de produits -->
            <div class="col-lg-3 col-md-6">
                <div class="card card-stats text-center p-4">
                    <div class="icon mb-2"><i class="fa fa-gift fa-2x"></i></div>
                    <h5>Produits</h5>
                    <h3><?= $countArtisans['totalProduit'] ?></h3>
                </div>
            </div>

            <!-- Nombre de commandes -->
            <div class="col-lg-3 col-md-6">
                <div class="card card-stats text-center p-4">
                    <div class="icon mb-2"><i class="fa fa-shopping-cart fa-2x"></i></div>
                    <h5>Commandes</h5>
                    <h3><?= $countArtisans['totalCommande'] ?></h3>
                </div>
            </div>

            <!-- Informations boutique -->
            <div class="col-lg-3 col-md-6">
                <div class="card card-stats text-center p-4">
                    <div class="icon mb-2"><i class="fa fa-info-circle fa-2x"></i></div>
                    <h5>Boutique</h5>
                    <p>Conakry, Guinée</p>
                </div>
            </div>

        </div>

    </div>
</div>

<!-- ===== Footer ===== -->
    <?php require_once __DIR__ . "/../footer.php"; ?>



</body>
</html>
