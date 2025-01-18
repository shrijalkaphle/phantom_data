<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function AccountSettingView($user_id)
    {
        $user=DB ::table('users')->where('id',$user_id)->first();
        return view('User.accountSetting',compact('user'));
    }


    public function verifyEmail(Request $request)
    {
        $email=$request->email;
        $verify_email=DB::table('users')->where('email',$email)->first();
        if($verify_email)
        {
            return response()->json(['duplicateEntry' => "Already Registered"]);
        }else{
            return response()->json(['success' => "Continue"]);

        }
    }

    public function updateAccountSetting(Request $request)
    {
        $password=$request->password;
        $verify_user=DB::table('users')->where('id',$request->user_id)->first();
        if($verify_user){
            if(Hash::check($password, $verify_user->password)){
                $contactInfo = [
           
                    'name' => $request->name,
                    'last_name'=>$request->last_name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            
                DB::table('users') // Replace 'contacts' with your table name
                ->where('id', $request->user_id)
                ->update($contactInfo);
                return response()->json(['success' => "Account Updated"]);

            }else{
                return response()->json(['incorrectPassword' => "Password Not Correct"]);
            }
        }else{
            return response()->json(['errro402' => "Opps! Something went wrong !"]);
        }
    }

    public function passwordUpdateView($user_id)
    {
        $user=DB::table('users')->where('id',$user_id)->first();

        return view('User.passwordUpdate',compact('user'));
    }
    public function updatePassword(Request $request)
    {
        $currentPassword=$request->currentPassword;
        $verify_user=DB::table('users')->where('id',$request->user_id)->first();
        if($verify_user){
            if(Hash::check($currentPassword, $verify_user->password)){
                $contactInfo = [
           
                    'password' => Hash::make($request->newPassword),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            
                DB::table('users')
                ->where('id', $request->user_id)
                ->update($contactInfo);
                return response()->json(['success' => "Account Updated"]);

            }else{
                return response()->json(['incorrectPassword' => "Password Not Correct"]);
            }
        }else{
            return response()->json(['errro402' => "Opps! Something went wrong !"]);
        }
    }
}
