# Projet "BeatmapSelector"

Ceci est un projet personnel également destiné à être présenté dans le cadre du passage du titre professionnel dans la formation "Développeur Web et Web mobile" à Simplon.
**Ce README sera complété au fur et à mesure de l'avancement du projet.**

## Initialisation du projet

### 1 - Cloner le dépôt

```sh
git clone https://github.com/hojulien/mapslist.git
cd mapslist
```

### 2 - Configurer le projet

Le site nécessite [Composer](https://getcomposer.org/) et PHP.

```sh
composer install
```

Dupliquer le fichier `.env.exemple`, puis générer la clé d'application:

```sh
cp .env.example .env
```

```sh
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

```sh
php artisan migrate
```

Une fois toutes ces opérations effectuées, vous pouvez lancer le projet via `php artisan serve`.
