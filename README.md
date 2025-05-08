# MacCoffee PGI - Progiciel de Gestion Intégré

## Aperçu
Ce projet est un **Progiciel de Gestion Intégré (PGI)** sur mesure développé pour **MacCoffee**, une entreprise en phase de démarrage nécessitant un outil centralisé pour gérer ses processus opérationnels. Réalisé dans le cadre du **BTS SIO SLAM 2025** au **Lycée Paul Sabatier, Carcassonne**, l'application offre une interface web intuitive pour simplifier la gestion des clients, du personnel, des produits, des stocks, des commandes, des réservations, des réductions et des fournisseurs.

## Fonctionnalités
L'application prend en charge les fonctionnalités suivantes :
- **Gestion des utilisateurs** : Ajouter, modifier, supprimer des utilisateurs avec des permissions basées sur les rôles (administrateur, employé, etc.).
- **Gestion des clients** : Enregistrer et gérer les informations des clients (nom, email, téléphone) pour un suivi personnalisé.
- **Gestion des produits et catégories** : Maintenir un catalogue avec les détails des produits (nom, description, prix, image) et des catégories.
- **Gestion des stocks** : Suivre les quantités disponibles en inventaire.
- **Gestion des commandes** : Enregistrer et suivre les commandes (sur place ou réservées), incluant les sous-totaux, taxes et réductions.
- **Gestion des réservations** : Planifier et suivre les réservations avec des codes uniques et numéros de table.
- **Gestion des réductions** : Appliquer des offres promotionnelles avec type (pourcentage/fixe), valeur et date d'expiration.
- **Gestion des fournisseurs** : Stocker les informations des fournisseurs (nom, adresse, téléphone).
- **Tableau de bord** : Visualiser les métriques clés (ventes, stocks bas, réservations à venir) avec des graphiques interactifs alimentés par Chart.js.

## Exigences non fonctionnelles
- **Design adaptatif** : Interface conviviale adaptée aux écrans desktop et mobile grâce à Bootstrap.
- **Sécurité** : Authentification avec Laravel Auth, protection contre les attaques CSRF et gestion des permissions par rôles.
- **Évolutivité** : Conçue pour supporter une augmentation des utilisateurs et des volumes de données.

## Technologies utilisées
- **Backend** : Laravel (PHP) avec Eloquent ORM pour les interactions avec la base de données.
- **Frontend** : Templates Blade, Bootstrap, JavaScript (Chart.js pour les graphiques, Selectric pour les listes déroulantes dynamiques).
- **Base de données** : MySQL pour le stockage des données relationnelles.
- **Contrôle de version** : Git pour la gestion du code.
- **Environnement de développement** : MAMP pour le développement local.

## Architecture
L'application suit le modèle **MVC (Modèle-Vue-Contrôleur)** de Laravel :
- **Modèles** : Représentent les entités (par ex., `User`, `Customer`, `Product`, `Order`) avec des relations (par ex., `belongsTo` pour produit-catégorie).
- **Vues** : Templates Blade pour un rendu réutilisable et dynamique.
- **Contrôleurs** : Gèrent les requêtes HTTP, le traitement des formulaires et les opérations CRUD.

## Installation
1. **Cloner le dépôt** :
   ```bash
   git clone https://github.com/votre-repo/maccoffee-pgi.git
   ```
2. **Installer les dépendances** :
   ```bash
   composer install
   npm install
   ```
3. **Configurer l'environnement** :
   - Copier `.env.example` vers `.env` et mettre à jour les informations de la base de données.
   - Générer la clé d'application :
     ```bash
     php artisan key:generate
     ```
4. **Exécuter les migrations** :
   ```bash
   php artisan migrate
   ```
5. **Démarrer le serveur** :
   ```bash
   php artisan serve
   ```
6. Accéder à l'application via `http://localhost:8000`.

## Utilisation
- **Accès** : Connectez-vous avec des identifiants administrateur pour accéder au tableau de bord et aux fonctionnalités de gestion.
- **Tableau de bord** : Visualisez les statistiques en temps réel et les graphiques pour les ventes, les niveaux de stock et les réservations.
- **Gestion** : Utilisez la barre latérale pour naviguer vers les sections de gestion des clients, produits, commandes, etc.
- **Opérations CRUD** : Ajoutez, modifiez ou supprimez des enregistrements avec des formulaires sécurisés et des invites de confirmation.

## Défis et solutions
- **Relations entre entités** : La liaison des produits aux catégories a été résolue avec la relation `belongsTo` d'Eloquent.
- **Graphiques dynamiques** : La synchronisation des données pour Chart.js a été optimisée avec des requêtes et une sérialisation JSON.

## Résultats
Le PGI répond pleinement aux besoins opérationnels de MacCoffee avec une interface conviviale et robuste. Il est prêt à évoluer avec l'ajout de nouvelles entités ou d'analyses avancées.

## Documentation
- Les détails complets du projet et le code source sont disponibles sur GitHub : [https://fustimolnarpatrick.com](https://fustimolnarpatrick.com).
- Consultez le dépôt pour les schémas de base de données, diagrammes et documentation supplémentaire.

## Auteur
- **Patrick Fusti Molnar**
- Développé dans le cadre du BTS SIO SLAM, Lycée Paul Sabatier, Carcassonne
- Date d'achèvement : Avril 2025