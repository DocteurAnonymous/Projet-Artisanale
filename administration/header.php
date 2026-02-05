<?php
define('BASE_URL', '/PROJET_ARTISANALE/administration');
$page = basename($_SERVER['PHP_SELF']);


require_once __DIR__ . "/../Config/db.php";
require_once __DIR__ . "/../Backend/Authentification/admin.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_GET['logout'])) {
    $pdo = connectionDB();
    $admin = new Administrateurs($pdo);
    $admin->Deconnexion();

    header('Location: ' . BASE_URL . '/../Auth/login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">

<header class="header-area header-sticky">
    <div class="container">
        <nav class="main-nav">
            <a href="<?= BASE_URL ?>/tableaudeboard.php" class="logo">
                <h1>ArtisanShop</h1>
            </a>
            <ul class="nav">
                <li><a href="<?= BASE_URL ?>/tableaudeboard.php" class="<?= $page == 'tableaudeboard.php' ? 'active' : '' ?>" >Dashboard</a></li>
                <li><a href="<?= BASE_URL ?>/artisan/artisan.php" class="<?= $page == 'artisan.php' ? 'active' : '' ?>" >Artisans</a></li>
                <li><a href="<?= BASE_URL ?>/galerie/galerie.php" class="<?= $page == 'galerie.php' ? 'active' : '' ?>" >Galeries</a></li>
                <li><a href="<?= BASE_URL ?>/produit/produit.php" class="<?= $page == 'produit.php' ? 'active' : '' ?>" >Produits</a></li>
                <li><a href="<?= BASE_URL ?>/commande/commande.php" class="<?= $page == 'commande.php' ? 'active' : '' ?>" >Commandes</a></li>
                <li><a href="?logout=1" class="bg-danger text-white rounded">Déconnexion</a></li>
                <li><li>
            </ul>
        </nav>
    </div>
</header>
