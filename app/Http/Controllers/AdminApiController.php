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
            //$token = $admin->createToken('admin-token')->plainTextToken;
            //add time to token 
            $token = $admin->createToken('admin-token')->plainTextToken;
            $adminName = $admin->name;
            /* $token->token->expires_at = now()->addHours(2); // Set the expiration time 2 hours from now
            $token->token->save(); */
            
            return response()->json(['message' => 'Authentication successful','admin_name'=>$adminName,'token' => $token]);
        } else {
            // Authentication failed
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
    }
    

    
    
    
    
    
    
}
