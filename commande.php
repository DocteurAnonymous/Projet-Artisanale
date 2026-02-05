<?php 

    require_once __DIR__ . "/Config/db.php";
    require_once __DIR__ . "/Backend/Commande/commande.php";
    require_once __DIR__ . "/Backend/Produit/produit.php";


    // Se connecter a la base de données
    $pdo = connectionDB();

    //Recupérer la liste des produits
    $produits = new Produits($pdo);
    $listeProduits = $produits->GetProduits();

    $commande = new Commandes($pdo);

    // Déclarer les variables d'error
    $errornom = $erroremail = $errortel = $errorprod = $errordescription = "";
    $nom = $email = $telephone = $produit_id = $description = "";
    $error = false;
    $succes = false;

    if($_POST) {

        $nom = trim($_POST['nom'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $telephone = trim($_POST['telephone'] ?? '');
        $produit_id = trim($_POST['produit_id'] ?? '');
        $description = trim($_POST['description'] ?? '');
        if ($nom == "") {
            $errornom = "Veuillez renseigner votre nom";
            $error = true;
        }
        if ($email == "") {
            $erroremail = "Veuillez renseigner votre email";
            $error = true;
        }
        if ($telephone == "") {
            $errortel = "Veuillez renseigner votre numéro de téléphone";
            $error = true;
        }
        if ($produit_id == "") {
            $errorprod = "Veuillez renseigner le type de produit";
            $error = true;
        }
        if ($description == "") {
            $errordescription = "Veuillez renseigner votre demande";
            $error = true;
        }
        if ($error == false) {
            try {
                $commandeProduit =  $commande->PasserCommande($nom, $email, $telephone, $produit_id, $description);
                $succes = true;
                $errornom = $erroremail = $errortel = $errorprod = $errordescription = "";
                $nom = $email = $telephone = $produit_id = $description = "";
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

    <title>Passer une commande | ArtisanShop</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS du template -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-villa-agency.css">
</head>

<body>

    <?php require_once __DIR__ . "/header.php"; ?>


<!-- ===== Titre de la page ===== -->
<div class="page-heading header-text">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h3>Commande & Demande personnalisée</h3>
                <span class="breadcrumb">
                    Accueil / Passer une commande
                </span>
            </div>
        </div>
    </div>
</div>

<!-- ===== Formulaire ===== -->
<div class="contact-page section">
    <div class="container">
        <div class="row">

            <!-- Infos -->
            <div class="col-lg-5">
                <div class="section-heading">
                    <h6>| Commande</h6>
                    <h2>Faites une demande personnalisée</h2>
                </div>
                <p>
                    Vous pouvez commander un produit existant ou faire une
                    demande personnalisée selon vos besoins.  
                    Nos artisans locaux vous répondront dans les meilleurs délais.
                </p>
            </div>

            <!-- Formulaire -->
            <div class="col-lg-7">
                <form id="contact-form" action="" method="post">
                    <?php if (!empty($succes)) : ?>
                        <h6 class="text-success text-center mb-3">
                            Votre commande a été envoyée avec succès <br>
                            Nous vous contacterons bientôt
                        </h6>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-lg-6">
                            <fieldset>
                                <input type="text" name="nom" class="form-control" placeholder="Votre nom complet" value="<?= $nom ?>" >
                                <span class="text-danger"><?= $errornom ?></span>
                            </fieldset>
                        </div>

                        <div class="col-lg-6">
                            <fieldset>
                                <input type="email" name="email" class="form-control" placeholder="Votre adresse email" value="<?= $email ?>">
                                <span class="text-danger"><?= $erroremail ?></span>
                            </fieldset>
                        </div>

                        <div class="col-lg-6">
                            <fieldset>
                                <input type="tel" name="telephone" class="form-control" placeholder="Téléphone" value="<?= $telephone ?>">
                                <span class="text-danger"><?= $errortel ?></span>
                            </fieldset>
                        </div>

                        <div class="col-lg-6">
                            <fieldset>
                                <select name="produit_id" class="form-control">
                                    <option value="">Type de produit</option>
                                    <?php foreach($listeProduits as $produits): ?>
                                        <option value="<?= $produits['id'] ?>"><?= $produits['nom'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span class="text-danger"><?= $errorprod ?></span>
                            </fieldset>
                        </div>

                        <div class="col-lg-12">
                            <fieldset>
                                <textarea name="description" rows="5" class="form-control"
                                    placeholder="Décrivez votre commande ou votre demande personnalisée..."
                                    > <?= $description ?> </textarea>
                                <span class="text-danger"><?= $errordescription ?></span>
                            </fieldset>
                        </div>

                        <div class="col-lg-12">
                            <fieldset>
                                <button type="submit" class="orange-button">
                                    Envoyer la demande
                                </button>
                            </fieldset>
                        </div>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

<?php require_once __DIR__ . "/footer.php"; ?>


</body>
</html>
