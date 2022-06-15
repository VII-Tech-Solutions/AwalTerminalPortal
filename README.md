# Awal Terminal Portal

## Setup
```bash
cp readme/.env .env
composer install
php artisan migrate
npm install
npm run dev
#php artisan filament:upgrade
#php artisan db:seed
php artisan storage:link
```

## Links
- Payment Local `http://credimax.test/checkout?return_url=http%3A%2F%2Fawal.test%2Felite-service%2Fpay%2Fprocess&amount=0.1&order_id=100000&description=Test`
- Payment Staging `https://awal-credimax.viitech.net/checkout?return_url=https://awal-credimax.viitech.net/elite-service/pay/process&amount=0.1&order_id=100000&description=Test`
