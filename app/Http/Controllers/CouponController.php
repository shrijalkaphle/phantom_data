<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CouponController extends Controller
{
    public function verifyCoupon(Request $request)
    {
       $input_coupon = $request->coupon_code;
       $verify_coupon = DB::table('coupons')->where('code',$input_coupon)->first();
       if($verify_coupon)
       {
        return response()->json(
            [
                'success' => $verify_coupon->discount,
                'coupon_id' => $verify_coupon->id
            ]);
       }else{
        return response()->json(['error' => "Invalid Coupon"]);
       }
    }
}
