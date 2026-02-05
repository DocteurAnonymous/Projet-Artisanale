# ArtisanShop

ArtisanShop est une plateforme web dédiée à la valorisation de l’artisanat local.
Le projet permet de présenter des produits artisanaux, des artisans, une galerie
d’images et de gérer les commandes des clients.

Une interface d’administration sécurisée permet la gestion complète des contenus
(produits, artisans, galeries, commandes et administrateurs).

---

## Fonctionnalités principales
- Gestion des produits (ajout, modification, suppression)
- Gestion des artisans et de leurs informations
- Galerie d’images classées par type
- Gestion des commandes clients (traitement, suppression)
- Authentification administrateur (connexion / déconnexion)
- Upload et gestion des images
- Interface responsive avec Bootstrap

---

## Technologies utilisées
- PHP (Programmation orientée objet)
- MySQL 
- HTML5 / CSS3
- Bootstrap
- JavaScript
- PDO pour l’accès à la base de données

---

## Installation et configuration

### 1️⃣ Cloner le projet
```bash
git clone https://github.com/DocteurAnonymous/Projet-Artisanale.git
```
2️⃣ Placer le projet dans le serveur local

XAMPP
Copier le dossier du projet dans :

C:\xampp\htdocs\


WAMP
Copier le dossier du projet dans :

C:\wamp64\www\

3️⃣ Créer la base de données

Ouvrir phpMyAdmin

Créer une base de données nommée :

projet_artisanale

4️⃣ Importer la base de données

Sélectionner la base projet_artisanale

Cliquer sur Importer

Choisir le fichier :

config/db.sql


Cliquer sur Exécuter

5️⃣ Configuration de la base de données

Vérifier le fichier :

Config/db.php

6️⃣ Lancer le projet

Dans le navigateur :

http://localhost/PROJET_ARTISANALE/
