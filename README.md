# victorgbn-iim-a4-symfony-aidsh

## Installation

### Prérequis 

* [Composer](https://getcomposer.org/download/)
* [Symfony](https://symfony.com/download)
* [WAMP](https://www.wampserver.com) - Seulement sur Windows
* [MAMP](https://www.mamp.info/en/downloads/) - Seulement sur macOS

Après avoir clone le projet dans un nouveau répertoire local, instanciez le projet : 

```
composer install
```

### Base de donnée

Créez un fichier `.env.local` dans lequel vous mettrez vos informations de connexion à la base de donnée selon votre environnement de travail, dans la variable `DATABASE_URL=`. Ouvrez votre serveur local MAMP / WAMP et lancez ces commandes :

```
php bin/console doctrine:database:create
php bin/console make:migration
php bin/console doctrine:migrations:migrate
```

Lancez les fixtures afin de remplir la base de donnée : 
```
php bin/console doctrine:fixtures:load
```

## Lancer le projet 

Lancez le projet à l'aide de la commande suivante : 
```
symfony server:start
```
