<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
            $userToken = $newUser->createToken('auth_token')->plainTextToken;

            return response()->json([
                'success' => true,
                'message' => 'User created successfully',
                'token' => $userToken,
                'user' => $user,
            ], 201);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed because: ' . json_encode($e->errors()),
            ], 422);
        } catch (\Exception $e) {
            Log::error('User creation error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to create user because: ' . json_encode($e->getMessage()),
            ], 500);
        }
    }



}

// "token": "1|896ufTBn3K8A1SWjFKLuHZOroZmxXWAT7z2XN7pf0b5a3ddc"
