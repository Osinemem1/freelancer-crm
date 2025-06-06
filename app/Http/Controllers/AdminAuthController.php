<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    //
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::guard('admin')->attempt($credentials)) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }
        

    }


        public function logout()
        {
            Auth::guard('admin')->logout();
            return response()->json(['message' => 'Logged out']);
        }

        
}
