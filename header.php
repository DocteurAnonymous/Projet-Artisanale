<?php
    define('BASE_URL', '/PROJET_ARTISANALE');
    $page = basename($_SERVER['PHP_SELF']);
?>
    <!-- Début de l'entete de notre page accueuil -->
    <div class="sub-header">
        <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8">
            <ul class="info">
                <li><i class="fa fa-envelope"></i> artisanshop@gmail.com</li>
                <li><i class="fa fa-map"></i> Sonfonia-Centre en face du commissariat</li>
            </ul>
            </div>
            <div class="col-lg-4 col-md-4">
            <ul class="social-links">
                <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                <li><a href="https://x.com/minthu" target="_blank"><i class="fab fa-twitter"></i></a></li>
                <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                <li><a href="#"><i class="fab fa-instagram"></i></a></li>
            </ul>
            </div>
        </div>
        </div>
    </div>
    <!-- Fin de l'entete de notre page accueuil -->

    <!-- Début de notre barre de navigation -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="index.php" class="logo">
                            <h1>ArtisanShop</h1>
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li><a href="<?= BASE_URL ?>/index.php" class="<?= $page == 'index.php' ? 'active' : '' ?>">Accueil</a></li>
                            <li><a href="<?= BASE_URL ?>/index.php#presentation" class="<?= $page == 'index.php#presentation' ? 'active' : '' ?>" >Présentations</a></li>
                            <li><a href="<?= BASE_URL ?>/index.php#galeries" class="<?= $page == 'index.php#galeries' ? 'active' : '' ?>" >Galeries</a></li>
                            <li><a href="<?= BASE_URL ?>/index.php#produits" class="<?= $page == 'index.php#produits' ? 'active' : '' ?>" >Nos produits</a></li>
                            <li><a href="<?= BASE_URL ?>/commande.php" class="<?= $page == 'commande.php' ? 'active' : '' ?>">Commander</a></li>
                            <li><a href="<?= BASE_URL ?>/apropos.php" class="<?= $page == 'apropos.php' ? 'active' : '' ?>">A propos</a></li>
                            <li><a href="<?= BASE_URL ?>/Auth/login.php" class="<?= $page == 'login.php' ? 'active' : '' ?>">Administration</a></li>
                            <li></li>
                        </ul>   
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- Fin de notre barre de navigation -->