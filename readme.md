# Application Frais

## Pré-requis

- PHP >= 7.2
- Composer >= 1.6.4
- npm >= 5.6.0
- git >= 2.16.2

## Installation

- `git clone git@github.com:aymericpasco/applifrais.git`
- `cd applifrais`
- `composer install`
- Cloner `.env.example`, renommer`.env` et l'éditer.
- `php artisan key:generate`
- `php artisan migrate --seed`
- `npm install`