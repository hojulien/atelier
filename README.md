# BeatmapSelector

Ceci est un mini moteur de recherche dédié aux beatmaps (niveaux de jeu) du jeu de rythme gratuit [osu!](https://osu.ppy.sh/). Il est destiné à compléter le moteur de recherche du site officiel avec davantage de fonctionnalités de filtres de beatmaps et de gestion de playlists.

Réalisé et présenté pour le titre professionnel "Développement web et web mobile" à Simplon.

**Ce projet n'est pas affilié directement à osu! et n'a aucun but de l'être.**

## Fonctionnalités

- **Création de compte** avec authentification et sécurisation
- **Liste des beatmaps** avec redirection vers leur page sur le site officiel
- **Gestion de playlists** (création/partage via le profil public utilisateur)
- **Possibilité d'envoyer des suggestions** (via formulaire) aux administrateurs pour des recommendations d'images et/ou de musiques
- **Possibilité de mettre des maps en favori**
- **Profil public utilisateur** avec les maps mis en favori ainsi que les playlists publiques associées à cet utilisateur

## Initialisation du projet

### 1 - Cloner le dépôt

```sh
git clone https://github.com/hojulien/atelier.git
cd atelier
```

### 2 - Configurer le projet

Le site nécessite [Composer](https://getcomposer.org/) et PHP.

```sh
composer install
```

Dupliquer le fichier `.env.example`, puis générer la clé d'application:

```sh
cp .env.example .env
php artisan key:generate
```

Ouvrir le fichier `.env` et y configurer `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` selon la configuration locale.

### 3 - Lancer le projet

Le projet utilisant **VITE** pour le chargement du CSS et du JS, il est nécessaire d'installer **npm**. Vous pouvez le trouver intégré à [Node.js](https://nodejs.org/).

```sh
npm install
npm run dev
```

Il est ensuite nécessaire d'effectuer les migrations pour créer les tables:
Des données sont fournies via les seeders, que vous pouvez ajouter:

```sh
php artisan migrate --seed
```

Une fois toutes ces opérations effectuées, vous pouvez lancer le projet via `php artisan serve`.

## Technologies utilisées

- **Laravel, framework PHP** basé sur le modèle MVC et la programmation objet, ajoutant des fonctionnalités comme la gestion des modèles, des routes, des vues et autres.
- **Blade**, moteur de modèles pour générer les vues, qui consiste en un **HTML** dans lequel on peut injecter du code **PHP**.
- **CSS3** pour la stylisation des vues.
- **JavaScript** pour des interactions (évènements) et la sécurité (formulaires) côté client.
- **Git** pour le versioning et la gestion de projet.
- **Visual Studio Code** pour le développement du code.
