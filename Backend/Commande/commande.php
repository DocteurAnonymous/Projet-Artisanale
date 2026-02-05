<?php 
    require_once __DIR__ . "/../../Config/db.php";

    class Commandes {

        private $pdo;

        public function __construct($pdo)
        {
            $this->pdo = $pdo;
        }

        //Passer une commande
        public function PasserCommande($nom,$email,$telephone,$produit_id,$description) {
            $requete = $this->pdo->prepare("INSERT INTO commandes (nom,email,telephone,produit_id,description) VALUES (:nom,:email,:telephone,:produit_id,:description) ");
            return $requete->execute([
                ':nom' => $nom,
                ':email' => $email,
                ':telephone' => $telephone,
                ':produit_id' => $produit_id,
                ':description' => $description
            ]);
        }

        // Liste des commandes 
        public function ListeCommande() {
            $requete = $this->pdo->prepare("SELECT commandes.*,  produits.nom AS nom_produit FROM commandes JOIN produits ON commandes.produit_id = produits.id ");
            $requete->execute();
            $liste = $requete->fetchAll(PDO::FETCH_ASSOC);
            return $liste;
        }
        
        // Supprimer une commande
        public function SupprimerCommande($id) {
            $requete = $this->pdo->prepare("DELETE FROM commandes WHERE id = :id");
            return $requete->execute([
                ':id' => $id
            ]);
        }

        //Traiter une commande
        public function TraiterCommande($id) {
            $requete = $this->pdo->prepare("UPDATE `commandes` SET `statut` = 'valider' WHERE `commandes`.`id`= :id");
            return $requete->execute([
                ':id' => $id
            ]);
        }
    }

        

    