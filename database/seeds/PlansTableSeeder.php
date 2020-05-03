<?php

use App\Plan;
use Illuminate\Database\Seeder;

class PlansTableSeeder extends Seeder
{
    public function run()
    {
        $plans = [];
        for ($planId=1; $planId<=5; $planId++) {
            if (env('PLAN_' . $planId . '_ENABLED')) {
                $plans[] = [
                    'name'              => env('STRIPE_NAME_PLAN_' . $planId),
                    'price'             => env('STRIPE_PRICE_PLAN_' . $planId),
                    'stripe_plan_id'    => env('STRIPE_ID_PLAN_' . $planId),
                    'free_trial_days'   => env('STRIPE_FREE_TRIAL_DAYS_PLAN_' . $planId),
                    'created_at'        => now(),
                    'billing_period'    => env('STRIPE_BILLING_PERIOD_PLAN_' . $planId),
                ];
            }
        }
        Plan::insert($plans);
    }
}
