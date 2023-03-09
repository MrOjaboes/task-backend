<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    public function signUp(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
             ]);
        if ($validator->fails()) {
            return response()->json([
                'validator_errors' => $validator->errors(),
            ]);
        } else {

            $user = User::create([
               'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
              $token =  $user->createToken('loginToken', ['login'])->plainTextToken;
            return response()->json([
                'status' => 200,
                'token' => $token,
                'message' => 'Registration Successful',
            ]);
        }
    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'validator_errors' => $validator->errors(),
            ]);
        } else {
            $user = User::where('email', $request->email)->first();
            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json([
                    'status' => 401,
                    'message' => 'Invalid Credentials!',
                ]);
            } else {
                  $token = $user->createToken('auth_token', ['login'])->plainTextToken;
                return response()->json([
                    'status' => 200,
                    'token' => $token,
                    'message' => 'Logged in Successfully',
                ]);
            }
        }
    }
    public function logout()
    {
        $user = Auth::user()->token();
        $user->revoke();
       // auth()->user()->tokens()->delete();
        return ['message' => 'successfully logged out and the token was successfully deleted'];
    }
}
