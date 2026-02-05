<?php
require_once __DIR__ . "/../../Config/db.php";
require_once __DIR__ . "/../../Backend/Galerie/galerie.php";

$pdo = connectionDB();
$galerieInstance = new Galeries($pdo);

$id = $_GET['id'] ?? null;
if (!$id) {
    die("Aucun ID fourni");
}

// Récupérer la galerie existante
$galerie = $galerieInstance->Search($id); // il faudra créer la fonction Search si pas déjà

// Déclarer les variables d'erreur
$errornom = $errortype = $errorimage = "";
$nom   = $galerie[0]['nom'] ?? '';
$type  = $galerie[0]['type'] ?? '';
$image = $galerie[0]['image'] ?? '';
$error = false;
$succes = false;

if ($_POST) {

    $nom  = trim($_POST['nom'] ?? '');
    $type = trim($_POST['type'] ?? '');

    // Validation
    if ($nom == "") {
        $errornom = "Veuillez renseigner le nom de l'image";
        $error = true;
    }
    if ($type == "") {
        $errortype = "Veuillez renseigner le type de l'image";
        $error = true;
    }

    /* ===== TRAITEMENT IMAGE ===== */
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {

        $dossier = __DIR__ . "/../../assets/images/Galeries/";
        if (!is_dir($dossier)) {
            mkdir($dossier, 0777, true);
        }

        $extension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $extensionsAutorisees = ['jpg','jpeg','png','webp'];

        if (!in_array($extension, $extensionsAutorisees)) {
            $errorimage = "Format d'image non autorisé";
            $error = true;
        } else {
            // Supprimer l'ancienne image si elle existe
            if ($image && file_exists($dossier . $image)) {
                unlink($dossier . $image);
            }

            // Renommer et déplacer la nouvelle image
            $image = uniqid('galerie_') . '.' . $extension;
            if (!move_uploaded_file($_FILES['image']['tmp_name'], $dossier . $image)) {
                $errorimage = "Impossible de déplacer l'image";
                $error = true;
            }
        }
    }
    // Si aucune image envoyée, on garde l'image actuelle

    // Mise à jour en DB si pas d'erreur
    if (!$error) {
        try {
            $galerieInstance->ModifierGalerie($id, $image, $nom, $type);
            $succes = true;
        } catch (\Throwable $th) {
            die($th->getMessage());
        }
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Gestion Galerie | ArtisanShop Admin</title>

    <!-- Bootstrap -->
    <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/fontawesome.css">
    <link rel="stylesheet" href="../../assets/css/templatemo-villa-agency.css">

    <style>
        .card-img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 6px;
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
                <h3>Gestion de la Galerie</h3>
                <span class="breadcrumb">Dashboard / Galerie</span>
            </div>
        </div>
    </div>
</div>

<!-- ===== Section : Formulaire d'ajout ===== -->
<div class="section py-5">
    <div class="container">
        <div class="row">

            <!-- Formulaire d'ajout -->
            <div class="col-lg-12">
                <div class="section-heading">
                    <h6>| Ajouter une image</h6>
                    <h2>Formulaire</h2>
                </div>
                <?php if ($succes) :?>
                    <h6 class="text-center text-success">Image modifié avec succès</h6>
                <?php endif?>
                <form id="form-galerie" action="#" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label>Nom de l'image</label>
                        <input type="text" name="nom" class="form-control" value="<?= $nom ?>">
                        <span class="text-danger"><?= $errornom ?></span>
                    </div>
                    <div class="mb-3">
                        <label>Type</label>
                        <input type="text" name="type" class="form-control" value="<?= $type ?>">
                        <span class="text-danger"><?= $errortype ?></span>

                    </div>
                    <div class="mb-3">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control" accept="image/*" >
                        <span class="text-danger"><?= $errorimage ?></span>
                    </div>
                    <button type="submit" class="btn btn-primary">Ajouter à la galerie</button>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- ===== Footer ===== -->
    <?php require_once __DIR__ . "/../../footer.php"; ?>




</body>
</html>
