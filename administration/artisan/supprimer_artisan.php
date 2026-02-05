<?php
require_once __DIR__ . "/../../Config/db.php";
require_once __DIR__ . "/../../Backend/Artisan/artisan.php";

$pdo = connectionDB();


$artisan = new Artisans($pdo);

if (isset($_GET['id'])) {
    $artisan->Supprimer($_GET['id']);
}

// Redirection
header("Location: artisan.php");

exit;