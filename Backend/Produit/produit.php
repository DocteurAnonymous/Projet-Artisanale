<?php 
    require_once __DIR__ . "/../../Config/db.php";

    class Produits {

        private $pdo;

        public function __construct($pdo)
        {
            $this->pdo = $pdo;
        }

        //La liste des produits
        public function GetProduits() {
            $requete = $this->pdo->prepare("SELECT * FROM produits");
            $requete->execute();
            $liste = $requete->fetchAll(PDO::FETCH_ASSOC);
            return $liste;
        }

        //Ajout d'un produit
        public function AjoutProduit($nom, $categorie, $prix, $image, $description) {
            $requete = $this->pdo->prepare("INSERT INTO produits (nom,categorie,prix,image,description) VALUES (:nom,:categorie,:prix,:image,:description) ");

            return $requete->execute([
                ':nom' => $nom,
                ':categorie' => $categorie,
                ':prix' => $prix,
                ':image' => $image,
                ':description' => $description
            ]);
        }

        // Mise à jour d'un produit
        public function ModifierProduit($id, $nom, $categorie, $prix, $image, $description) {
            // Préparer la requête
            $requete = $this->pdo->prepare("UPDATE produits SET nom = :nom, categorie = :categorie, prix = :prix, image = :image, description = :description WHERE id = :id ");
            // Exécuter avec les paramètres
            return $requete->execute([
                ':id' => $id,
                ':nom' => $nom,
                ':categorie' => $categorie,
                ':prix' => $prix,
                ':image' => $image,
                ':description' => $description
            ]);
        }



        // Supprimer un produit
        public function Supprimer($id) {
            $requete = $this->pdo->prepare("DELETE FROM produits WHERE id = :id");
            return $requete->execute([
                ':id' => $id
            ]);
        }

        // Rechercher un produit
        public function Search($id) {
            $requete = $this->pdo->prepare("SELECT * FROM produits WHERE id = :id");
            $requete->execute([
                ':id' => $id
            ]);
            $liste = $requete->fetchAll(PDO::FETCH_ASSOC);
            return $liste;
        }
        

    }