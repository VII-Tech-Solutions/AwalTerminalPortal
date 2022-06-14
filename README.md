# Awal Terminal Portal

## Setup
```bash
cp readme/.env .env
composer install
php artisan migrate
npm install
npm run dev
php artisan filament:upgrade
php artisan db:seed
php artisan storage:link
```


## Links
- Payment `http://credimax.test/checkout?return_url=http%3A%2F%2Fawal.test%2Felite-service%2Fpay%2Fprocess&amount=0.1&order_id=100000&description=Test`
