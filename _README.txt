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

You will need 3 products to be set up in Stripe with a pricing plan under each of them
# Go here to set up https://dashboard.stripe.com/test/products and for each product, you must have a plan.
# Most important: Make sure the details match with what is in Stripe
# Stripe plan IDs MUST match the plan IDs under product. Example: https://dashboard.stripe.com/test/plans/yearly_plan
# The prices must match the prices in Stripe, otherwise billing math will be way off.
# The billing period also needs to match what is in Stripe, otherwise customers may get billed incorrectly.

PLAN_1_ENABLED=1
STRIPE_NAME_PLAN_1="Monthly Plan"
STRIPE_PRICE_PLAN_1=14900
STRIPE_ID_PLAN_1=monthly_plan
STRIPE_BILLING_PERIOD_PLAN_1=monthly

PLAN_2_ENABLED=1
STRIPE_NAME_PLAN_2="Yearly Plan"
STRIPE_PRICE_PLAN_2=120000
STRIPE_ID_PLAN_2=yearly_plan
STRIPE_BILLING_PERIOD_PLAN_2=yearly

PLAN_3_ENABLED=1
STRIPE_NAME_PLAN_3="Forever Plan"
STRIPE_PRICE_PLAN_3=500000
STRIPE_ID_PLAN_3=forever_plan
STRIPE_BILLING_PERIOD_PLAN_3=

(mail settings for sending email)
MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=f6654ef6db0675
MAIL_PASSWORD=cb9de536150f4f
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=kunal@keenbrain.com
MAIL_FROM_NAME='Kunal at KeenBrain'

4. create db named: laravel_saas_demo_project_laraveldaily_stripe_subscriptions)
5. run: composer install
6. run: php artisan key:generate
7. run: php artisan migrate:fresh --seed
8. run: pas
go to http://127.0.0.1:8000/
