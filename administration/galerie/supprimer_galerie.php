<?php
require_once __DIR__ . "/../../Config/db.php";
require_once __DIR__ . "/../../Backend/Galerie/galerie.php";

$pdo = connectionDB();


$galerie = new Galeries($pdo);

if (isset($_GET['id'])) {
    $galerie->Supprimer($_GET['id']);
}

// Redirection
header("Location: galerie.php");

exit;