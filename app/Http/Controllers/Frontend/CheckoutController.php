<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\DeliveryArea;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    function index(){
        $addresses = Address::where(['user_id' => auth()->user()->id])->get();
        $deliveryAreas = DeliveryArea::where('status', 1)->get();

        return view('frontend.pages.checkout', compact('addresses', 'deliveryAreas'));
    }

    function CalculateDeliveryCharge(string $id) {
        try {
            $address = Address::findOrFail($id);
            $cartTotal = cartTotal();
            $deliveryFee = (float) ($address->deliveryArea?->delivery_fee ?? 0);
            $grandTotal = (float) ($cartTotal + $deliveryFee);
            
            if(session()->has('coupon')) {
                $discount = (float) session()->get('coupon')['discount'];
                $grandTotal = $grandTotal - $discount;
            }

            logger('Debug values:', [
                'cartTotal' => $cartTotal,
                'deliveryFee' => $deliveryFee,
                'discount' => session()->get('coupon')['discount'] ?? 0,
                'grandTotal' => $grandTotal
            ]);

            return response([
                'delivery_fee' => (int) $deliveryFee,
                'grand_total' => (int) $grandTotal
            ]);
        }catch(\Exception $e) {
            logger($e);
            return response(['message' => 'Something Went Wrong!'], 422);
        }
    }

    function checkoutRedirect(Request $request)  {
        $request->validate([
            'id' => ['required', 'integer']
        ]);

        $address = Address::with('deliveryArea')->findOrFail($request->id);

        $selectedAddress = $address->address.', Aria: '. $address->deliveryArea?->area_name;

        session()->put('address', $selectedAddress);
        session()->put('delivery_fee', $address->deliveryArea->delivery_fee);
        session()->put('address_id', $address->id);


        return response(['redirect_url' => route('payment.index')]);
    }
}
