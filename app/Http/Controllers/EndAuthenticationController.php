<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Validator;

class EndAuthenticationController extends Controller
{


    public function getCrendential(Request $request)
    {
        try {
            // Validate request
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|min:10',
                'password' => 'required|string|min:6',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed because: ' . json_encode($validator->errors()),
                ], 422);
            }

            // Retrieve validated data
            $credentials = $request->only('email', 'password');

            // Attempt to authenticate the user
            if (!Auth::attempt($credentials)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid credentials',
                ], 401);
            }

            $user = Auth::user();

            // Check if the user is deleted
            if ($user->is_deleted == 'Yes') {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found or has been deleted',
                ], 404);
            }

            // Fetch user roles and API tokens
            $user = User::where('users.id', $user->id)
                ->join('roles as r', 'users.role_id', '=', 'r.id')
                ->join('user_api_tokens as uat', 'users.id', '=', 'uat.user_id')
                ->select('users.id','users.name','users.nickname', 'users.email', 'users.phone', 'users.image', 'r.title as role', 'uat.raw_token', 'uat.user_key', 'uat.hash_token')
                ->first();

            // Prepare response data
            $imageUrl = asset('storage/images/users/' . $user->image);

            $responseData = [
                'user-id' => $user->id,
                'name' => $user->name,
                'nickname' => $user->nickname,
                'email' => $user->email,
                'phone' => $user->phone,
                'image' => $imageUrl,
                'role' => $user->role,
                'token' => $user->raw_token,
                'userKey' => $user->user_key,
                'apiKey' => $user->hash_token,
            ];

            return response()->json([
                'success' => true,
                'message' => 'User found',
                'data' => $responseData
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred: ' . $e->getMessage(),
            ], 500);
        }
    }


}
