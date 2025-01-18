<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;



class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $email= $request->email;
        $password= $request->password;
        $verify_user=DB::table('users')->where('email',$email)->first();
        if($verify_user){
            if(Hash::check($password, $verify_user->password)){
                //$request->authenticate();
                //$request->session()->regenerate();
                //$intendedUrl = redirect()->intended(RouteServiceProvider::HOME)->getTargetUrl();
                return response()->json(['success' => true, 'user_details' => $verify_user]);
            }else{
                return response()->json(['passwordIncorrect' => "Incorrect Password"]);

            }
        }else{
            return response()->json(['emaiNotFound' => "Email Not Found"]);
        }
        

    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
