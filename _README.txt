For laravel_saas_demo_project_laraveldaily_stripe_subscriptions:

Installation:
1. git clone https://github.com/connecteev/Laravel-SaaS-Demo-Project
(because there are some commits I made to it)
and NOT https://github.com/LaravelDaily/Laravel-SaaS-Demo-Project

2. cp .env.example .env 

3. edit .env and add the following settings:
DB_DATABASE=laravel_saas_demo_project_laraveldaily_stripe_subscriptions
(create db named laravel_saas_demo_project_laraveldaily_stripe_subscriptions)
STRIPE_KEY=
STRIPE_SECRET=
(stripe keys from https://dashboard.stripe.com/test/apikeys)

4. create db named: laravel_saas_demo_project_laraveldaily_stripe_subscriptions)
5. run: composer install
6. run: php artisan key:generate
7. run: php artisan migrate:fresh --seed
8. run: pas
go to http://127.0.0.1:8000/
