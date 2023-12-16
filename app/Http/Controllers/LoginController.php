<?php

namespace App\Http\Controllers;

use App\Models\AdminUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    public function auth(Request $request)
    {
        
        $username = $request->input('username');
        $password = $request->input('password');

        $user = AdminUser::where('username', $username)->first();
        if ($user) {
            if(Hash::check($password, $user->password)) {
                // Make the authorization expiring

                Auth::login($user, false);
                return redirect()->intended('/dashboard')->with('success', 'Giriş yapıldı!');
            }
        }

        return back()->with('error', 'Girilen bilgiler eşleşmiyor!');
    }


}
