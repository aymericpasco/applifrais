# Application Frais

## Requis

- PHP >= 7.2
- Composer >= 1.6.4
- npm >= 5.6.0
- git >= 2.16.2

## Installation

- `git clone git@github.com:aymericpasco/applifrais.git`
- `cd applifrais`
- `composer install`
- Clone `.env.example`, rename it `.env` and edit it with your onw config.
- `php artisan key:generate`
- `php artisan migrate`
- `npm install`