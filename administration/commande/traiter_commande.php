<?php
require_once __DIR__ . "/../../Config/db.php";
require_once __DIR__ . "/../../Backend/Commande/commande.php";

$pdo = connectionDB();


$commande = new Commandes($pdo);

if (isset($_GET['id'])) {
    $commande->TraiterCommande ($_GET['id']);
}

// Redirection
header("Location: commande.php");

exit;