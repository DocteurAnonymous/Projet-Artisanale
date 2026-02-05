<?php
require_once __DIR__ . "/../../Config/db.php";
require_once __DIR__ . "/../../Backend/Produit/produit.php";

$pdo = connectionDB();


$produit = new Produits($pdo);

if (isset($_GET['id'])) {
    $produit->Supprimer($_GET['id']);
}

// Redirection
header("Location: produit.php");

exit;