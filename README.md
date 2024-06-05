# Test technique Novaway

## Objectif

Bienvenue sur le test technique Novaway. Le but de ce test est d'évaluer la façon dont vous travaillez sur une base de code PHP Symfony.

L'idée est de voir comment vous mettez en place les bonnes pratiques de développement.

Ce projet est un mini site pseudo e-commerce, avec une base de code contenant des erreurs et/ou des choses à améliorer.

Certaines seront volontaires et parfois évidentes, le chemin n'est pas déjà tracé, libre à vous de faire les modifications qui vous semblent nécessaires.

## Setup

Prérequis
PHP 8.0 minimum

Clonez le projet et lancez le serveur PHP standalone
```
git clone https://gitlab.novaway.net/dev-team/test-recrutement
cd test-novaway
composer install
npm i
./node_modules/.bin/encore dev
php -S 127.0.0.1:8000 -t public
```

La base de données est en SQLite, donc il n'est pas nécessaire de créer et configurer un SQL local.

Le site est accessible sur http://127.0.0.1:8000

## Modifications

Pour plus de lisibilité et de compréhension de vos modifications, vous devez les ajouter au controle de code source via **dans des commits séparés**.

Eventuellement, vous pouvez préciser le temps passé sur chaque correction/amélioration.

Si vous voyez des modifications qui demanderaient trop de temps pour être réalisées dans le cadre de ce test, n'hésitez pas à les expliquer dans ce fichier README, cela nous permet de mieux comprendre votre façon d'organiser le code.

Bon refactoring !
