<?php
require_once __DIR__ . "/../../Config/db.php";
require_once __DIR__ . "/../../Backend/Artisan/artisan.php"; // adapter le chemin si besoin

$pdo = connectionDB();
$artisan = new Artisans($pdo);

// Déclarer les variables d'erreur
$errornom = $errorprenom = $erroradresse = $errortel = $errormetier = $errordescription = $errorimage = "";
$nom = $prenom = $adresse = $telephone = $metier = $description = $image = "";
$error = false;
$succes = false;

if ($_POST) {

    $nom         = trim($_POST['nom'] ?? '');
    $prenom      = trim($_POST['prenom'] ?? '');
    $adresse     = trim($_POST['adresse'] ?? '');
    $telephone   = trim($_POST['telephone'] ?? '');
    $metier      = trim($_POST['metier'] ?? '');
    $description = trim($_POST['description'] ?? '');

    // Validation des champs
    if ($nom == "") {
        $errornom = "Veuillez renseigner le nom";
        $error = true;
    }
    if ($prenom == "") {
        $errorprenom = "Veuillez renseigner le prénom";
        $error = true;
    }
    if ($adresse == "") {
        $erroradresse = "Veuillez renseigner l'adresse";
        $error = true;
    }
    if ($telephone == "") {
        $errortel = "Veuillez renseigner le téléphone";
        $error = true;
    }
    if ($metier == "") {
        $errormetier = "Veuillez renseigner le métier";
        $error = true;
    }
    if ($description == "") {
        $errordescription = "Veuillez renseigner la description";
        $error = true;
    }

    /* ===== TRAITEMENT IMAGE ===== */
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {

        $dossier = __DIR__ . "/../../assets/images/Artisans/";
        if (!is_dir($dossier)) {
            mkdir($dossier, 0777, true); // créer le dossier si inexistant
        }

        $extension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $extensionsAutorisees = ['jpg', 'jpeg', 'png', 'webp'];

        if (!in_array($extension, $extensionsAutorisees)) {
            $errorimage = "Format d'image non autorisé";
            $error = true;
        } else {
            // Renommer l’image
            $image = uniqid('artisan_') . '.' . $extension;
            if (!move_uploaded_file($_FILES['image']['tmp_name'], $dossier . $image)) {
                $errorimage = "Impossible de déplacer l'image";
                $error = true;
            }
        }

    } else {
        $errorimage = "Veuillez ajouter une image";
        $error = true;
    }

    // Si pas d'erreur, insertion dans la DB
    if ($error == false) {
        try {
            $AjoutArtisan = $artisan->AjoutArtisan($nom, $prenom, $adresse, $telephone, $metier, $description, $image);
            $succes = true;

            // Réinitialiser les champs
            $nom = $prenom = $adresse = $telephone = $metier = $description = $image = "";
            $errornom = $errorprenom = $erroradresse = $errortel = $errormetier = $errordescription = $errorimage = "";

        } catch (\Throwable $th) {
            die($th);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Gestion Artisans | ArtisanShop Admin</title>

    <!-- Bootstrap -->
    <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/fontawesome.css">
    <link rel="stylesheet" href="../../assets/css/templatemo-villa-agency.css">

    <style>
        .card-img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 50%;
        }
        .card-stats {
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
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
                <h3>Gestion des Artisans</h3>
                <span class="breadcrumb">Dashboard / Artisans</span>
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
                    <h6>| Ajouter un Artisan</h6>
                    <h2>Formulaire</h2>
                </div>
                <?php if ($succes) :?>
                    <h6 class="text-center text-success">Artisan ajouté avec succès</h6>
                <?php endif?>
                <form id="form-artisan" action="#" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label>Nom</label>
                        <input type="text" name="nom" class="form-control" value="<?= $nom ?>">
                        <span class="text-danger"><?= $errornom ?></span>
                    </div>
                    <div class="mb-3">
                        <label>Prénom</label>
                        <input type="text" name="prenom" class="form-control" value="<?= $prenom ?>" >
                        <span class="text-danger"><?= $errorprenom ?></span>
                    </div>
                    <div class="mb-3">
                        <label>Adresse</label>
                        <input type="text" name="adresse" class="form-control" value="<?= $adresse ?>">
                        <span class="text-danger"><?= $erroradresse ?></span>
                    </div>
                    <div class="mb-3">
                        <label>Téléphone</label>
                        <input type="tel" name="telephone" class="form-control" value="<?= $telephone ?>">
                        <span class="text-danger"><?= $errortel ?></span>
                    </div>
                    <div class="mb-3">
                        <label>Métier</label>
                        <input type="text" name="metier" class="form-control" value="<?= $metier ?>">
                        <span class="text-danger"><?= $errormetier ?></span>
                    </div>
                    <div class="mb-3">
                        <label>Description</label>
                        <textarea name="description" class="form-control" rows="3" placeholder="Courte description..." ><?= $description ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Photo</label>
                        <input type="file" name="image" class="form-control" accept="image/*" >
                        <span class="text-danger"><?= $errorimage ?></span>
                    </div>
                    <button type="submit" class="btn btn-primary">Ajouter l'artisan</button>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- ===== Footer ===== -->
    <?php require_once __DIR__ . "/../../footer.php"; ?>


</body>
</html>
