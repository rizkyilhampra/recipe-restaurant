# Laravel React through Inertia.js

## PHP built-in server

> [!IMPORTANT]
> Needed PHP ^8.2

```bash
git clone https://github.com/rizkyilhampra/recipe-restaurant.git
cd recipe-restaurant
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed
npm install
composer run dev
```

## Docker (Through Sail)

> [!NOTE]
> Include PostgreSQL

```bash
git clone https://github.com/rizkyilhampra/recipe-restaurant.git
cd recipe-restaurant
```

```bash
composer install || docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php83-composer:latest \
    composer install --ignore-platform-reqs \
```

```bash
./vendor/bin/sail up -d
cp .env.example .env
./vendor/bin/sail artisan key:generate
./vendor/bin/sail artisan migrate:fresh --seed
./vendor/bin/sail npm install
./vendor/bin/sail npm run dev
```

## Test

> [!NOTE]
> Include phpstan, pint, and pest

```bash
composer run test
```

or with Sail

> One line command

```bash
./vendor/bin/sail bin pint --test && \
./vendor/bin/sail bin phpstan analyse --memory-limit=1G && \
./vendor/bin/sail bin pest
```
