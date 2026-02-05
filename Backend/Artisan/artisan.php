<?php 
require_once __DIR__ . "/../../Config/db.php";

class Artisans {

    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Liste de tous les artisans
    public function GetArtisans() {
        $requete = $this->pdo->prepare("SELECT * FROM artisans");
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ajouter un artisan
    public function AjoutArtisan($nom, $prenom, $adresse, $telephone, $metier, $description, $image) {
        $requete = $this->pdo->prepare("
            INSERT INTO artisans (nom, prenom, adresse, telephone, metier, description, image, created_at, updated_at)
            VALUES (:nom, :prenom, :adresse, :telephone, :metier, :description, :image, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)
        ");
        return $requete->execute([
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':adresse' => $adresse,
            ':telephone' => $telephone,
            ':metier' => $metier,
            ':description' => $description,
            ':image' => $image
        ]);
    }

    // Modifier un artisan
    public function ModifierArtisan($id, $nom, $prenom, $adresse, $telephone, $metier, $description, $image) {
        $requete = $this->pdo->prepare("
            UPDATE artisans 
            SET nom = :nom, prenom = :prenom, adresse = :adresse, telephone = :telephone, 
                metier = :metier, description = :description, image = :image, updated_at = CURRENT_TIMESTAMP
            WHERE id = :id
        ");
        return $requete->execute([
            ':id' => $id,
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':adresse' => $adresse,
            ':telephone' => $telephone,
            ':metier' => $metier,
            ':description' => $description,
            ':image' => $image
        ]);
    }

    // Supprimer un artisan
    public function Supprimer($id) {
        $requete = $this->pdo->prepare("DELETE FROM artisans WHERE id = :id");
        return $requete->execute([':id' => $id]);
    }

    // Rechercher un artisan par ID
    public function Search($id) {
        $requete = $this->pdo->prepare("SELECT * FROM artisans WHERE id = :id");
        $requete->execute([':id' => $id]);
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }
}
