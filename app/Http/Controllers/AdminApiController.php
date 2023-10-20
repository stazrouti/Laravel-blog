<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\admin;


class AdminApiController extends Controller
{
    public function Login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $admin = Admin::where('email', $credentials['email'])->first();
    
        if ($admin && Hash::check($credentials['password'], $admin->password)) {
            $token = $admin->createToken('admin-token')->plainTextToken;
            return response()->json(['message' => 'Authentication successful','token' => $token]);
        } else {
            // Authentication failed
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
    }
    

    
    
    
    
    
    
}
