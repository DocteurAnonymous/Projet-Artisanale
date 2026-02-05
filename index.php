<?php 

    require_once __DIR__ . "/Config/db.php";
    require_once __DIR__ . "/Backend/Produit/produit.php";
    require_once __DIR__ . "/Backend/Artisan/artisan.php";
    require_once __DIR__ . "/Backend/Galerie/galerie.php";

    // Se connecter a la base de données
    $pdo = connectionDB();

    //Recupérer la liste des produits
    $produits = new Produits($pdo);
    $listeProduits = $produits->GetProduits();

    //Recupérer la liste des artisans
    $artisans = new Artisans($pdo);
    $listeartisans = $artisans->GetArtisans();

    //Recupérer la liste des images
    $galeries = new Galeries($pdo);
    $listegaleries = $galeries->GetGaleries();


?>

<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

        <title>Projet Artisanale</title>

        <!-- Bootstrap core CSS -->
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


        <!-- Additional CSS Files -->
        <link rel="stylesheet" href="assets/css/galerie.css">
        <link rel="stylesheet" href="assets/css/fontawesome.css">
        <link rel="stylesheet" href="assets/css/templatemo-villa-agency.css">
        <link rel="stylesheet" href="assets/css/owl.css">
        <link rel="stylesheet" href="assets/css/animate.css">
        <link rel="stylesheet"href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>

    </head>
<body>

    <!-- Début de la div chargement -->
    <div id="js-preloader" class="js-preloader">
        <div class="preloader-inner">
            <span class="dot"></span>
                <div class="dots">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
        </div>
    </div>
    <!-- Fin de la div chargement -->

    <?php require_once __DIR__ . "/header.php"; ?>

    <!-- Début de nos carousels -->
    <div class="main-banner">
        <div class="owl-carousel owl-banner">
        <div class="item item-1">
            <div class="header-text">
            <span class="category">Artisanat local, <em>Savoir-faire</em></span>
            <h2>Des mains expertes!<br>Des créations uniques</h2>
            </div>
        </div>
        <div class="item item-2">
            <div class="header-text">
            <span class="category">Produits faits main, <em>Qualité</em></span>
            <h2>Chaque pièce raconte<br>une histoire</h2>
            </div>
        </div>
        <div class="item item-3">
            <div class="header-text">
            <span class="category">Talents d'ici, <em>Authenticité</em></span>
            <h2>Soutenez les artisans<br>Découvrez l'exception</h2>
            </div>
        </div>
        </div>
    </div>
    <!-- Fin de nos carousels -->

    <!-- Début de la présentation de nos artisans -->
    <div id="presentation" class="featured section py-5 bg-light">
        <div class="container">
            
            <!-- Titre -->
            <div class="row mb-4">
                <div class="col text-center">
                    <h2 class="fw-bold">Nos Artisans</h2>
                    <p class="text-muted">
                        Découvrez les artisans locaux et leur savoir-faire traditionnel
                    </p>
                </div>
            </div>

            <!-- Artisans -->
            <div class="row g-4">

                <?php foreach ( $listeartisans as $artisan): ?>
                <!-- Artisan 1 -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card border-0 shadow h-100">
                        <div class="" style="height: 35vh;">
                            <a href="#artisan-<?= $artisan['id'] ?>">
                                <img src="assets/images/Artisans/<?= $artisan['image'] ?>" style="height: 100%; width: 100%; object-fit: cover;" class="card-img-top" alt="<?= $artisan['image'] ?>">
                            </a>

                            <div id="artisan-<?= $artisan['id'] ?>" class="lightbox">
                                <a href="#close" class="close-btn">&times;</a>
                                <img src="assets/images/Artisans/<?= $artisan['image'] ?>">
                            </div>

                        </div>
                        <div class="card-body text-center">
                            <h5 class="card-title fw-bold"><?= $artisan['prenom'] . '  ' . $artisan['nom'] ?></h5>
                            <span class="badge bg-warning text-dark mb-2"><?= $artisan['metier'] ?></span>
                            <p class="card-text text-muted mt-2">
                                <?= $artisan['description'] ?>
                            </p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>

            </div>
        </div>
    </div>
    <!-- Fin de la présentation de nos artisans -->


    <!-- Début la partie galerie -->
    <div id="galeries" class="section py-5 bg-light">
        <div class="container">

            <!-- Titre -->
            <div class="row mb-4">
                <div class="col text-center">
                    <h2 class="fw-bold">Galerie Artisanale</h2>
                    <p class="text-muted">Bijoux, textile, sculpture et poterie</p>
                </div>
            </div>

            <!-- Galerie -->
            <div class="row g-4">

                <?php foreach ( $listegaleries as $image): ?>
                <!-- Item -->
                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                    <div class="gallery-item"
                        data-bs-toggle="modal" 
                        data-bs-target="#imageModal"
                        data-image="assets/images/Galeries/<?= $image['image'] ?>"
                        data-title="<?= $image['type'] ?>"
                        data-type="<?= $image['nom'] ?>">
                        <img src="assets/images/Galeries/<?= $image['image'] ?>" class="img-fluid" alt="">
                        <div class="overlay">
                            <h6><?= $image['type'] ?></h6>
                            <span><?= $image['nom'] ?></span>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="imageModal" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content border-0">
                            <div class="modal-body p-0">
                                <img id="modalImage" src="" class="img-fluid w-100" alt="">
                                <div class="p-3 text-center">
                                    <h5 id="modalTitle" class="fw-bold mb-1"></h5>
                                    <span id="modalType" class="text-muted"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>

            </div>
        </div>
    </div>
    <!-- Fin la partie galerie -->

    <!-- Debut de la partie produit -->
    <div id="produits" class="properties section">
        <div class="container">

            <!-- Titre -->
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="section-heading text-center">
                        <h6>| Nos Produits</h6>
                        <h2>L’authenticité artisanale qui raconte notre culture</h2>
                    </div>
                </div>
            </div>

            <!-- Produits -->
            <div class="row">

                <?php foreach ( $listeProduits as $produit): ?>

                <!-- Produit 1 -->
                <div class="col-lg-4 col-md-6">
                    <div class="item">
                        <a href="#produit-<?= $produit['id'] ?>">
                            <img src="assets/images/Produits/<?= $produit['image'] ?>" alt="<?= $produit['nom'] ?>" class="product-img">
                        </a>

                        <div id="produit-<?= $produit['id'] ?>" class="lightbox">
                            <a href="#close" class="close-btn">&times;</a>
                            <img src="assets/images/Produits/<?= $produit['image'] ?>">
                        </div>

                        <span class="category"><?= $produit['categorie'] ?></span>
                        <h6><?= $produit['prix'] ?> GNF</h6>

                        <h4><?= $produit['nom'] ?></h4>

                        <p class="text-muted">
                            <?= $produit['description'] ?>
                        </p>

                    </div>
                </div>

                <?php endforeach; ?>


            </div>
        </div>
    </div>

    <!-- Fin de la partie produit -->

    <?php require_once __DIR__ . "/footer.php"; ?>


















    <!-- Scripts -->
    <!-- Script pour la modal image -->
    <script>
        document.querySelectorAll('.gallery-item').forEach(item => {
            item.addEventListener('click', function () {
                document.getElementById('modalImage').src = this.dataset.image;
                document.getElementById('modalTitle').textContent = this.dataset.title;
                document.getElementById('modalType').textContent = this.dataset.type;
            });
        });
    </script>
   


</body>
</html>