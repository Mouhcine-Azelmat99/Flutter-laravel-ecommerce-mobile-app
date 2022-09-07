<?php

namespace App\Http\Controllers;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\AuthenticationException;


use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
     //Register user
     public function register(Request $request)
     {
         //validate fields
         $attrs = $request->validate([
             'name' => 'required|string',
             'email' => 'required|email|unique:users,email',
             'password' => 'required|min:6'
         ]);

         //create user
         $user = User::create([
             'name' => $attrs['name'],
             'email' => $attrs['email'],
             'password' => bcrypt($attrs['password'])
         ]);

         //return user & token in response
         return response()->json($user->createToken('web')->plainTextToken,200);
     }

     // login user
     public function login(Request $request)
     {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            // 'device_name' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
         //return user & token in response
         return response()->json($user->createToken('web')->plainTextToken,200);

     }

     // logout user
     public function logout()
     {
        //  auth()->user()->tokens()->delete();
        Auth()->user()->tokens->delete();
         return response([
             'message' => 'Logout success.'
         ], 200);
     }

     // get user details
     public function user()
     {
         return response()->json(auth()->user(), 200);
     }
}
