<?php

namespace App\Http\Controllers;

use App\Country;
use App\Plan;
use Illuminate\Http\Request;
use Stripe\Coupon;
use Stripe\Stripe;
use Illuminate\Support\Carbon;

class CheckoutController extends Controller
{
    public function checkout($plan_id)
    {
        $plan = Plan::findOrFail($plan_id);
        $countries = Country::all();

        $currentPlan = auth()->user()->subscription('default')->stripe_plan ?? NULL;

        if (!is_null($currentPlan)) {
            if ($currentPlan != $plan->stripe_plan_id) {
                auth()->user()->subscription('default')->swap($plan->stripe_plan_id);
            }
            return redirect()->route('billing');
        }

        $subtotal = $plan->price;
        $taxPercent = auth()->user()->taxPercentage();
        $taxAmount = round($subtotal * $taxPercent / 100);
        $total = $subtotal + $taxAmount;

        $intent = auth()->user()->createSetupIntent();
        return view('billing.checkout', compact('plan', 'intent', 'countries',
            'subtotal', 'taxPercent', 'taxAmount', 'total'));
    }

    public function processCheckout(Request $request)
    {
        $plan = Plan::findOrFail($request->input('billing_plan_id'));
        try {
            $loggedinUser = auth()->user();
            if (!$loggedinUser) {
                return redirect()->route('billing')->withMessage('Sorry. You need to be logged in to do that!');
            }
            $newSubscription = $loggedinUser->newSubscription('default', $plan->stripe_plan_id);
            if ($plan->free_trial_days > 0) {
                $newSubscription->trialDays($plan->free_trial_days);
            }
            $newSubscription->withCoupon($request->input('coupon'))
                ->create($request->input('payment-method'));

            $loggedinUser->update([
                'trial_ends_at' => $plan->free_trial_days > 0 ? Carbon::now()->addDays($plan->free_trial_days) : NULL,
                'company_name' => $request->input('company_name'),
                'address_line_1' => $request->input('address_line_1'),
                'address_line_2' => $request->input('address_line_2'),
                'country_id' => $request->input('country_id'),
                'city' => $request->input('city'),
                'postcode' => $request->input('postcode'),
            ]);
            return redirect()->route('billing')->withMessage('Subscribed successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        }
    }

    public function checkCoupon(Request $request) {
        try {
            Stripe::setApiKey(env('STRIPE_SECRET'));
            $coupon = Coupon::retrieve($request->input('coupon_code'));
        } catch (\Exception $ex) {
            return response()->json(['error_text' => 'Coupon not found']);
        }

        return $coupon;
    }

}
