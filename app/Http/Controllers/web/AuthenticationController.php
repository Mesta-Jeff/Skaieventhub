<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthenticationController extends Controller
{
    //
    public function register(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => ['required', 'string'],
                'email' => ['required', 'email', 'unique:users'],
                'password' => ['required', 'min:6'],
            ]);
    
            $user = User:: create($data);
            $token = $user->createToken('auth_token')->plainTextToken;
    
            return response()->json([
                'user' => $user,
                'token' => $token
            ], 201);
    
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        }
    }

    public function getAllUsers(Request $request)
    {
        $users = User::all();
        return response()->json($users);
    }

    

    public function addUser(Request $request)
    {
        $token = $request->bearerToken();
        
        if (!$token) {
            return response()->json(['error' => 'Token not provided'], 401);
        }
        
        $user = auth()->user();
    
        if (!$user) {
            return response()->json(['error' => 'Invalid token'], 401);
        }
        
        try {
            $data = $request->validate([
                'name' => ['required', 'string'],
                'email' => ['required', 'email', 'unique:users'],
                'password' => ['required', 'min:6'],
            ]);

            $newUser = User::create($data);
            $usertoken = $newUser->createToken('auth_token')->plainTextToken;
            
            if ($usertoken) {
                return response()->json(['success' =>true,'message' => 'User token created successfully', 'token' => $usertoken], 201);
            } else {
                return response()->json(['success' =>false,'error' => 'Failed to create user token'], 500);
            }
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        }
    }

}


// 	"token": "1|wu8laMfC6SLT0ZV7DikBfRpEJRlGm7gV76s40GAGfd9c8dcf",
// "token": "2|azZpfuFg7zhpTO4441vzyqFxq4IHYXPOYJuStkSw76d92534",
// "token": "3|0j5vDQotAptBu7WuyfEiqQqeqt3I6C3Uo2KuG3Ii73a1758d"