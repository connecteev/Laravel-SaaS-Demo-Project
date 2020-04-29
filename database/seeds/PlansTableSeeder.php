<?php

use App\Plan;
use Illuminate\Database\Seeder;

class PlansTableSeeder extends Seeder
{
    public function run()
    {
        $plans = [
            [
                'name'              => 'Bronze Plan',
                'price'             => 999,
                'stripe_plan_id'    => '',
                'created_at'        => now(),
                'billing_period'    => 'monthly',
            ],
            [
                'name'              => 'Silver Plan',
                'price'             => 1999,
                'stripe_plan_id'    => '',
                'created_at'        => now(),
                'billing_period'    => 'monthly',
            ],
            [
                'name'              => 'Gold Plan',
                'price'             => 2999,
                'stripe_plan_id'    => '',
                'created_at'        => now(),
                'billing_period'    => 'monthly',
            ],
        ];

        Plan::insert($plans);
    }
}
