<?php
session_start();

require_once __DIR__ . "/../Config/db.php";
require_once __DIR__ . "/../Backend/Authentification/admin.php";

$pdo = connectionDB();
$admin = new Administrateurs($pdo);

$error = "";

/* ===== TRAITEMENT CONNEXION ===== */
if ($_POST) {

    $login = trim($_POST['login'] ?? '');
    $motdepasse = trim($_POST['motdepasse'] ?? '');

    if ($login === "" || $motdepasse === "") {
        $error = "Veuillez remplir tous les champs";
    } else {
        $connexion = $admin->Connexion($login, $motdepasse);

        if ($connexion) {
            $_SESSION['admin'] = [
                'id' => $connexion['id'],
                'login' => $connexion['login'],
                'nom' => $connexion['nom']
            ];

            header("Location: ../administration/tableaudeboard.php");
            exit;
        } else {
            $error = "Login ou mot de passe incorrect";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Connexion | ArtisanShop</title>

    <!-- Bootstrap -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS du template -->
    <link rel="stylesheet" href="../assets/css/fontawesome.css">
    <link rel="stylesheet" href="../assets/css/templatemo-villa-agency.css">
</head>

<body>

    <?php require_once __DIR__ . "/../header.php"; ?>

<!-- ===== FORMULAIRE ===== -->
<div class="section">
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-lg-5">
                <div class="card shadow p-4">

                    <h4 class="text-center mb-4">Accès Administrateur</h4>

                    <?php if ($error): ?>
                        <div class="alert alert-danger text-center">
                            <?= $error ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST">

                        <div class="mb-3">
                            <label class="form-label">Login</label>
                            <input type="text"
                                   name="login"
                                   class="form-control"
                                   placeholder="Votre login"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Mot de passe</label>
                            <input type="password"
                                   name="motdepasse"
                                   class="form-control"
                                   placeholder="Votre mot de passe"
                                   required>
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary">
                                Se connecter
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>


</body>
</html>
