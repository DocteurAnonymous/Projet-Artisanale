<?php
require_once __DIR__ . "/../../Config/db.php";

require_once __DIR__ . "/../../Backend/Produit/produit.php";

$pdo = connectionDB();
$produitInstance = new Produits($pdo);
$id = $_GET['id'];
if (!isset($id)) {
    die('aucun id');
}
    $produit = $produitInstance->Search($id);

    // Déclarer les variables d'error
    $errornom = $errorcategorie = $errorprix = $errorimage = "";
    $nom = $produit[0]['nom'];
    $categorie = $produit[0]['categorie'];
    $prix = $produit[0]['prix'];
    $image = $produit[0]['image'];
    $description = $produit[0]['description'];
    $error = false;
    $succes = false;

    if($_POST) {

        $nom = trim($_POST['nom'] ?? '');
        $categorie = trim($_POST['categorie'] ?? '');
        $prix = trim($_POST['prix'] ?? '');
        $description = trim($_POST['description'] ?? '');

        if ($nom == "") {
            $errornom = "Veuillez renseigner le nom du produit";
            $error = true;
        }
        if ($categorie == "") {
            $errorcategorie = "Veuillez renseigner la catégorie du produit";
            $error = true;
        }
        if ($prix == "") {
            $errorprix = "Veuillez renseigner le prix du produit";
            $error = true;
        }

        /* ===== TRAITEMENT IMAGE ===== */
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {

            $dossier = __DIR__ . "/../../assets/images/Produits/";
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

                // Renommer la nouvelle image
                $image = uniqid('produit_') . '.' . $extension;
                move_uploaded_file($_FILES['image']['tmp_name'], $dossier . $image);
            }
        }
        // Si aucune image envoyée, on garde l'image actuelle (pas besoin de faire autre chose)

        if ($error == false) {
            try {
                $produitInstance->ModifierProduit($id, $nom, $categorie, $prix, $image, $description);
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
    <title>Gestion Produits | ArtisanShop Admin</title>

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
                <h3>Gestion des Produits</h3>
                <span class="breadcrumb">Dashboard / Produits</span>
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
                    <h6>| Modifier un Produit</h6>
                    <h2>Formulaire</h2>
                </div>
                <?php if ($succes) :?>
                    <h6 class="text-center text-success">Produit modifié avec succès</h6>
                <?php endif?>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label>Nom du produit</label>
                        <input type="text" name="nom" class="form-control" value="<?= $nom ?>" >
                        <span class="text-danger"><?= $errornom ?></span>
                    </div>
                    <div class="mb-3">
                        <label>Catégorie</label>
                        <input type="text" name="categorie" class="form-control" value="<?= $categorie ?>" >
                        <span class="text-danger"><?= $errorcategorie ?></span>
                    </div>
                    <div class="mb-3">
                        <label>Prix (GNF)</label>
                        <input type="number" name="prix" class="form-control" value="<?= $prix ?>">
                        <span class="text-danger"><?= $errorprix ?></span>
                    </div>
                    <div class="mb-3">
                        <label>Description</label>
                        <textarea name="description" class="form-control" rows="3" placeholder="Description du produit..." ><?php echo $description; ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control" accept="image/*" >
                        <span class="text-danger"><?= $errorimage ?></span>
                    </div>
                    <button type="submit" class="btn btn-primary">Modifier le produit</button>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- ===== Footer ===== -->
    <?php require_once __DIR__ . "/../../footer.php"; ?>




</body>
</html>
