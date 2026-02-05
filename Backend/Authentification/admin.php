<?php
require_once __DIR__ . "/../../Config/db.php";

class Administrateurs {

    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    /* =======================
       INSCRIPTION ADMIN
    ======================= */
    public function Inscription($login, $motdepasse, $nom, $adresse, $telephone)
    {
        // Hash du mot de passe
        $passwordHash = password_hash($motdepasse, PASSWORD_DEFAULT);

        $requete = $this->pdo->prepare("
            INSERT INTO administrateurs (login, motdepasse, nom, adresse, telephone)
            VALUES (:login, :motdepasse, :nom, :adresse, :telephone)
        ");

        return $requete->execute([
            ':login' => $login,
            ':motdepasse' => $passwordHash,
            ':nom' => $nom,
            ':adresse' => $adresse,
            ':telephone' => $telephone
        ]);
    }

    /* =======================
       CONNEXION ADMIN
    ======================= */
    public function Connexion($login, $motdepasse)
    {
        $requete = $this->pdo->prepare("
            SELECT * FROM administrateurs WHERE login = :login
        ");
        $requete->execute([
            ':login' => $login
        ]);

        $admin = $requete->fetch(PDO::FETCH_ASSOC);

        if ($admin && password_verify($motdepasse, $admin['motdepasse'])) {
            return $admin; // succès
        }

        return false; // échec
    }

    /* =======================
       DECONNEXION ADMIN
    ======================= */
    public function Deconnexion()
    {
        session_start();
        session_unset();
        session_destroy();
        return true;
    }
}
