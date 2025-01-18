<?php

namespace App\Http\Controllers\User;

use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;


class ProfileController extends Controller
{
    public function dashboardView()
    {
        return view('dashboard');
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('sample_data')
                ->select(['title', 'views', 'status', 'created_at']);
            return DataTables::of($data)
                ->make(true);
        }

        return view('dashboard');
    }

    public function ProfileUpdateView($user_id)
    {
        $user=DB::table('users')->where('id',$user_id)->first();
        $last_transaction = DB::table('transactions')->where('email', $user->email)
            ->where('subscription_status', 1)
            ->where('monthly_subscription', 1)->latest('created_at')->first();
        return view('User.profile', compact('last_transaction','user'));
    }

    public function uploadAvatar(Request $request)
    {
       
        $request->validate([
            'uploadImg' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user =DB::table('users')->where('id',$request->user_id)->first(); 
        if ($request->hasFile('uploadImg')) {
            $image = $request->file('uploadImg');
            $imageName = $user->id . '_' . $user->name . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('avatars', $imageName, 'public');

            // Delete the old avatar if exists
            if ($user->profile_image) {
                Storage::disk('public')->delete($user->profile_image);
            }

            DB::table('users')->where('id',$user->id)->update([
                'profile_image'=> $imagePath,
            ]);

            return response()->json(['success' => true, 'avatar' => $imagePath]);
        }

        return response()->json(['success' => false, 'message' => 'Image upload failed']);
    }
    public function removeAvatar($user_id)
    {
    //     dd($user_id); 
        $user = DB::table('users')->where('id',$user_id)->first();

        // // Delete the avatar file if it exists
        if ($user->profile_image) {
            \Storage::disk('public')->delete($user->profile_image);
        }

        // // Set the avatar field to null
        DB::table('users')->where('id',$user_id)->update([
            'profile_image'=>null,
        ]);
        // $user->profile_image = null;
        // $user->save();

        return response()->json(['success' => true]);
    }

    public function updateProfile(Request $request)
    {
        $contactInfo = [

            'user_name' => $request->user_name,
            'position' => $request->position,
            'website' => $request->website,
            'about_description' => $request->about_description,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        DB::table('users') // Replace 'contacts' with your table name
            ->where('id', $request->user_id)
            ->update($contactInfo);
        return response()->json(['success' => "Account Updated"]);
    }


    public function howToUseView()
    {
        return view('User.howToUse');
        //return redirect('/web/assets/videos/loom-video.mp4');
    }

    public function purchaseMoreView($user_id)
    {
        $pricePerCredit=0.12;
        $user=DB::table('users')->where('id',$user_id)->first();
        $last_transaction = DB::table('transactions')->where('email', $user->email)
            ->where('monthly_subscription', 1)->latest('created_at')
            ->where('subscription_status', 1)->latest('created_at')->first();
            if ($user->user_source == 'Register') {
                $pricePerCredit = 0.10;
                if ($last_transaction) {
                    if ($last_transaction->amount == 120) {
                        $pricePerCredit = 0.12;
                    } elseif ($last_transaction->amount == 499) {
                        $pricePerCredit = 0.10;
                    } elseif ($last_transaction->amount == 999) {
                        $pricePerCredit = 0.05;
                    } elseif ($last_transaction->amount == 1999) {
                        $pricePerCredit = 0.04;
                    } elseif ($last_transaction->amount == 3499) {
                        $pricePerCredit = 0.035;
                    } elseif ($last_transaction->amount == 4999) {
                        $pricePerCredit = 0.02;
                    }
                }
            } else {
                if($user->user_source == 0.02) {
                    $pricePerCredit = 0.02;
                }elseif($user->user_source == 0.03){
                    $pricePerCredit = 0.03;
                
                }elseif($user->user_source == 0.04){
                    $pricePerCredit = 0.04;
                
                }elseif($user->user_source == 0.05){
                    $pricePerCredit = 0.05;
                }
            }
            
        return view('User.purchaseMore', compact('last_transaction','pricePerCredit'));
    }

    public function purchaseHistoryView()
    {
        return view('User.purchaseHistory');
    }

    public function getTransactionData(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('transactions')->where('email', $request->email)
                ->select(['amount', 'obtained_credits', 'coupon_id', 'subscription_status', 'transaction_status', 'created_at']);
            return DataTables::of($data)
                ->make(true);
        }
    }

    public function setProperties(Request $request)
    {
        $data = $request->all();
        echo "<br><pre>";
        print_r($data);

    }

    public function userTotalCredits(Request $request)
    {
        $userTotalCredits = DB::table('transactions')->where('email', $request->email)->latest('created_at')->value('current_total_credits');
        $userData = DB::table('users')->where('email', $request->email)->first();
        return response()->json([
            'status' => true,
            'userTotalCredits' => $userTotalCredits,
            'userData' => $userData,
        ]);
    }
    public function getUserLatestTransaction(Request $request)
    {
        $last_transaction = DB::table('transactions')->where('email', $request->email)
            ->where('monthly_subscription', 1)
            ->where('subscription_status', 1)
            ->first();
        if ($last_transaction) {
            return response()->json([
                'status' => true,
                'userLatestTransaction' => $last_transaction,
            ]);
        } else {
            return response()->json([
                'status' => false,
            ]);
        }
    }

    public function getUserFileNumber(Request $request)
    {
        $userData = DB::table('users')->where('id', $request->user_id)->first();
        $get_file_no = DB::table('properties')->where('user_id', $request->user_id)->latest()->first();
        $file_no = 1;
        if ($get_file_no) {
            $file_no = $file_no + $get_file_no->file_no;
        }
        $last_transaction = DB::table('transactions')->where('email', $userData->email)
            ->where('monthly_subscription', 1)
            ->where('subscription_status', 1)->latest()->first();
        $pricePerCredit = 0.10;
        if ($last_transaction) {
            if ($last_transaction->amount == 120) {
                $pricePerCredit = 0.12;
            } elseif ($last_transaction->amount == 499) {
                $pricePerCredit = 0.10;
            } elseif ($last_transaction->amount == 999) {
                $pricePerCredit = 0.05;
            } elseif ($last_transaction->amount == 1999) {
                $pricePerCredit = 0.04;
            } elseif ($last_transaction->amount == 3499) {
                $pricePerCredit = 0.035;
            } elseif ($last_transaction->amount == 4999) {
                $pricePerCredit = 0.02;
            }
        }
        return response()->json([
            'status' => true,
            'file_no' => $file_no,
            'userAvailableCredits' => $userData->credit,
            'pricePerCredit'=>$pricePerCredit,
            'last_transaction'=>$last_transaction,
        ]);
    }

    public function getUserDetails(Request $request)
    {
        $user_id=$request->user_id;
        $user=DB::table('users')->where('id',$user_id)->first();
        return response()->json([
            'status' => true,
            'user_details' => $user,
        ]);
    }



}
