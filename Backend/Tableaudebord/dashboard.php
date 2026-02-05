<?php

    require_once __DIR__ . "/../../Config/db.php";

    // retourner le nombre total d'artisans 
    function TotalDesDonnees() {

        $pdo = connectionDB();

        //Nombre d'artisans
        $requete = $pdo->prepare("SELECT COUNT(*) AS totalArtisans FROM artisans");
        $requete->execute();
        $resultat = $requete->fetch(PDO::FETCH_ASSOC);

        //Nombre de produits
        $requeteProduit = $pdo->prepare("SELECT COUNT(*) AS totalProduit FROM produits");
        $requeteProduit->execute();
        $resultatProduit = $requeteProduit->fetch(PDO::FETCH_ASSOC);

        //Nombre de commandes
        $requeteCommande = $pdo->prepare("SELECT COUNT(*) AS totalCommande FROM commandes");
        $requeteCommande->execute();
        $resultatCommande = $requeteCommande->fetch(PDO::FETCH_ASSOC);
       

        $nombreTotal = [ 'totalArtisans' => $resultat['totalArtisans'], 'totalProduit' => $resultatProduit['totalProduit'], 'totalCommande' =>$resultatCommande['totalCommande']];

        return $nombreTotal;
    }

    