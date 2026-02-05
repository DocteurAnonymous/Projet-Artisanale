<?php 
require_once __DIR__ . "/../../Config/db.php";

class Galeries {

    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Liste de toutes les galeries
    public function GetGaleries() {
        $requete = $this->pdo->prepare("SELECT * FROM galerie");
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ajouter une image à la galerie
    public function AjoutGalerie($image, $nom, $type) {
        $requete = $this->pdo->prepare("
            INSERT INTO galerie (image, nom, type, created_at, updated_at) 
            VALUES (:image, :nom, :type, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)
        ");
        return $requete->execute([
            ':image' => $image,
            ':nom' => $nom,
            ':type' => $type
        ]);
    }

    // Modifier une image de la galerie
    public function ModifierGalerie($id, $image, $nom, $type) {
        $requete = $this->pdo->prepare("
            UPDATE galerie 
            SET image = :image, nom = :nom, type = :type, updated_at = CURRENT_TIMESTAMP
            WHERE id = :id
        ");
        return $requete->execute([
            ':id' => $id,
            ':image' => $image,
            ':nom' => $nom,
            ':type' => $type
        ]);
    }

    // Supprimer une image de la galerie
    public function Supprimer($id) {
        $requete = $this->pdo->prepare("DELETE FROM galerie WHERE id = :id");
        return $requete->execute([
            ':id' => $id
        ]);
    }

    // Rechercher une image par ID
    public function Search($id) {
        $requete = $this->pdo->prepare("SELECT * FROM galerie WHERE id = :id");
        $requete->execute([
            ':id' => $id
        ]);
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

}
