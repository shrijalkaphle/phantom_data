<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;



use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function adminDashboardView()
    {
        $properties = DB::table('properties')->count();
        $users = DB::table('users')->count();
        $sold_credits = DB::table('transactions')->where('payment_type', 'Online')->sum('obtained_credits');
        $total_earning = DB::table('transactions')->where('payment_type', 'Online')->sum('amount');
        //dd($properties);
        return view('admin.dashboard', compact('properties', 'users', 'sold_credits', 'total_earning'));
    }
    public function usersListView()
    {
        return view('admin.Views.users.userList');
    }


    public function getUserData()
    {
        $users = DB::table('users')
            ->select('users.*')
            ->orderBy('users.id', 'desc')
            ->get();
        return DataTables::of($users)
            ->addColumn('subscription', function ($user) {
                $latestTransaction = DB::table('transactions')
                    ->where('email', $user->email)
                    ->where('payment_type', 'Online')
                    ->orderBy('created_at', 'desc')
                    ->first();
                if ($latestTransaction) {
                    return $latestTransaction;
                }
                return 'No transactions';
            })
            ->addColumn('action', function ($user) {
                return '';
            })
            ->make(true);
    }


    public function getTransactionData()
    {
        $transactions = DB::table('transactions')
            ->leftjoin('users', 'users.email', '=', 'transactions.email')
            ->leftjoin('coupons', 'coupons.id', '=', 'transactions.coupon_id')
            ->select('transactions.*', 'users.name as username', 'coupons.code')
            ->orderBy('transactions.id', 'desc')
            ->get();
        return DataTables::of($transactions)
            ->addColumn('action', function ($transactions) {
                return;
            })
            ->make(true);
    }

    public function getPropertiesData()
    {
        $properties = DB::table('properties')
            ->select('properties.*')
            ->orderBy('properties.id', 'desc')
            ->get();

        $results = []; // To store the final result

        foreach ($properties as $property) {
            $personalDetails = json_decode($property->personal_details, true);

            // Check if personal details exist
            if (!empty($personalDetails)) {
                foreach ($personalDetails as $detail) {
                    $results[] = [
                        'property_address' => $property->property_address,
                        'property_city' => $property->property_city,
                        'property_state' => $property->property_state,
                        'first_name' => $detail['first_name'] ?? 'N/A',
                        'last_name' => $detail['last_name'] ?? 'N/A',
                        'best_phone' => $detail['best_phone'] ?? 'N/A',
                    ];
                }
            } else {
                // Add a row with "N/A" values if there are no personal details
                $results[] = [
                    'property_address' => $property->property_address,
                    'property_city' => $property->property_city,
                    'property_state' => $property->property_state,
                    'first_name' => 'N/A',
                    'last_name' => 'N/A',
                    'best_phone' => 'N/A',
                ];
            }
        }

        return response()->json(['data' => $results]);
    }

    public function getUserProperties($user_id)
    {
        $properties = DB::table('properties')
            ->where('user_id', $user_id)
            ->select('properties.*')
            ->orderBy('properties.id', 'desc')
            ->get();

        $results = []; // To store the final result

        foreach ($properties as $property) {
            $personalDetails = json_decode($property->personal_details, true);

            // Check if personal details exist
            if (!empty($personalDetails)) {
                foreach ($personalDetails as $detail) {
                    $results[] = [
                        'property_address' => $property->property_address,
                        'property_city' => $property->property_city,
                        'property_state' => $property->property_state,
                        'first_name' => $detail['first_name'] ?? 'N/A',
                        'last_name' => $detail['last_name'] ?? 'N/A',
                        'best_phone' => $detail['best_phone'] ?? 'N/A',
                    ];
                }
            } else {
                // Add a row with "N/A" values if there are no personal details
                $results[] = [
                    'property_address' => $property->property_address,
                    'property_city' => $property->property_city,
                    'property_state' => $property->property_state,
                    'first_name' => 'N/A',
                    'last_name' => 'N/A',
                    'best_phone' => 'N/A',
                ];
            }
        }

        return response()->json(['data' => $results]);
    }

    public function updateCredits(Request $request)
    {

        $price_per_credit=0.10;
        $user_id = $request->user_id;
        $get_user_data = DB::table('users')->where('id', $user_id)->first();
        if($get_user_data->user_source == 0.02 ||$get_user_data->user_source == 0.03 || $get_user_data->user_source == 0.04 || $get_user_data->user_source == 0.05) {
            $price_per_credit = $get_user_data->user_source;
        }
        $add_credits = $request->credits;
        $amount = $add_credits * $price_per_credit;
        $token = $request->token;
      
        $set_user_data = DB::table('users')->where('id', $user_id)->update([
            'credit' => $get_user_data->credit + $add_credits,
            'updated_at' => now(),
        ]);
        $create_transaction = DB::table('transactions')->insert(
            [
                'email' => $get_user_data->email,
                'payment_id' => $token,
                'obtained_credits' => $add_credits,
                'amount' => $amount,
                'transaction_status' => 1,
                'payment_type' => 'Manually',
                'current_total_credits' => $get_user_data->credit + $add_credits,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        return response()->json(['message' => 'Credits Updated']);
    }


    public function couponsListView()
    {
        return view('admin.Views.coupons.couponsList');
    }

    public function getCouponsData()
    {
        $coupons = DB::table('coupons')
            ->select('coupons.*')
            ->orderBy('coupons.id', 'desc')
            ->get();
        return DataTables::of($coupons)
            ->addColumn('action', function ($coupons) {
                return;
            })
            ->make(true);
    }


    public function saveCoupon(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
            'discount' => 'required|numeric',
        ]);
        $couponCode = $request->code;
        $couponDiscount = $request->discount;
        DB::table('coupons')->insert([
            'code' => $couponCode,
            'discount' => $couponDiscount,
        ]);
        return response()->json([
            'message' => 'Coupon saved successfully!',
            'code' => $couponCode,
            'discount' => $couponDiscount
        ]);
    }


    public function hideCoupon($coupon_id)
    {
        $update_coupon = DB::table('coupons')->where('id', $coupon_id)->update(
            [
                "status" => 0,
                "updated_at" => now(),
            ]
        );
        return response()->json(['message' => 'success']);
    }
    public function showCoupon($coupon_id)
    {
        $update_coupon = DB::table('coupons')->where('id', $coupon_id)->update(
            [
                "status" => 1,
                "updated_at" => now(),
            ]
        );
        return response()->json(['message' => 'success']);
    }

    public function transactionListView()
    {
        return view('admin.Views.transactions.transactionList');
    }

    public function propertiesListView()
    {
        return view('admin.Views.properties.propertiesList');
    }

    public function addUser(Request $request)
    {
        //dd($request->all());
        $per_credits_rate= $request->credits_rate;
      
        $saveUser = [
            [
                'name' => $request->name,
                'last_name' => $request->last_name,
                'phone' => $request->phone,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'credit'=>0,
                'user_source'=>$per_credits_rate,
            ]
        ];
        $insertUser=DB::table('users')->insert($saveUser);
        if($insertUser)
        {
            return response()->json(['message'=> 'success']);
        }else{
            return response()->json(['message'=> 'failed']);
        }
    }

    public function getUserInfo(Request $request)
    {
        $user_id = $request->user_id;
        $user = DB::table('users')->where('id', $user_id)->first();
        if($user){
        return response()->json(['message'=> 'success','userInfo'=> $user]);
        }else{
            return response()->json(['message'=> 'error']);
        }
    }
  public function updateUserInfo(Request $request){
    $contactInfo = [
        'user_name' => $request->user_name,
        'position'=>$request->position,
        'phone'=>$request->phone,
        'user_source'=>$request->user_source?$request->user_source:'Register',
        'updated_at' => now(),
    ];
    DB::table('users')
    ->where('id', $request->user_id)
    ->update($contactInfo);
    return response()->json(['message' => "success"]);
  }
}
