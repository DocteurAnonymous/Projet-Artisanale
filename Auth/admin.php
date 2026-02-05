<?php 

    require_once __DIR__ . "/../Config/db.php";
    require_once __DIR__ . "/../Backend/Authentification/admin.php";

    $pdo = connectionDB();
    $adminInstance = new Administrateurs($pdo);
    $admin = $adminInstance->Inscription('Admin','admin123','Sano Ismael','Sangoyah','628013477');
    echo $admin;

?>