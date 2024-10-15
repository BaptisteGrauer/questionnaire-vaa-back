# Back-end questionnaire de satisfaction Va'a

## Pré-requis

- PHP 8.2
- Composer
- Symfony CLI
- Une base de données

## Installation

Récupérer le projet :
````shell
git clone [URL du projet] [dossier]
cd [dossier]
````
Installer les dépendances :
````shell
composer install
````

## Base de données

Créer une base de données et modifier le fichier ``.env`` avec les informations de connexion à la BDD en fonction du SGBD utilisé :

````
# DATABASE_URL="sqlite:///%kernel.project_dir%/var/data.db"
# DATABASE_URL="mysql://app::ChangeMe!@127.0.0.1:3306/app?serverVersion=8.0.32&charset=utf8mb4"
# DATABASE_URL="mysql://app:!ChangeMe!@127.0.0.1:3306/app?serverVersion=10.11.2-MariaDB&charset=utf8mb4"
# DATABASE_URL="postgresql://app:!ChangeMe!@127.0.0.1:5432/app?serverVersion=16&charset=utf8"
````

Créer les tables nécessaire au fonctionnement de l'application

````shell
php bin/console make:migration
php bin/console doctrine:migrations:migrate
````

## CORS

Dans le fichier ``config/packages/nelmio_cors.yaml``, modifier cette ligne suivante pour gérer qui peut envoyer des données à l'API:
````yaml
allow_origin: ['*']
````