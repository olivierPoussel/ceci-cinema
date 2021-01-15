# Cinema project
## get project
```bash
git clone https://github.com/olivierPoussel/ceci-cinema.git
```
## install project
```bash
composer install
php bin/console doctrine:database:create
php bin/console doctrine:migration:migrate
php bin/console doctrine:fixtures:load
```
## run project
```bash
symfony server:start
```