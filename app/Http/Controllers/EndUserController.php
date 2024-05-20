<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use App\Models\UserApiToken;
use App\Models\UserOTPToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class EndUserController extends Controller
{
    //
    // Users
    public function viewUser()
    {
        $users = User::all();
        return response()->json($users);
    }

    //Open route to create user
    public function register(Request $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->validate([
                'name' => ['required', 'string'],
                'email' => ['required', 'email', 'unique:users'],
                'password' => ['required', 'min:6'],
                'dob' => ['required', 'string'],
                'gender' => ['required', 'string'],
                'phone' => ['required', 'string'],
                'image' => ['required', 'string'],
            ]);

            $user = User::create($data);
            $token = $user->createToken('auth_token')->plainTextToken;

            // Generate encryption key
            $firstChar = substr($data['name'], 0, 1);
            $lastChar = substr($data['name'], -1);
            $randomNumbers = str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);
            $encryptionKey = $firstChar . $lastChar . '-' . $randomNumbers;

            $iv = Str::random(8);

            // Encrypt the token with OpenSSL using DES
            $encryptedToken = openssl_encrypt($token, 'des-cbc', $encryptionKey, 0, $iv);
            $encryptedToken = base64_encode($iv . $encryptedToken);

            // Save to user_api_tokens table
            UserApiToken::create([
                'user_id' => $user->id,
                'raw_token' => $token,
                'hash_token' => $encryptedToken,
                'user_key' => $encryptionKey
            ]);

            DB::commit();

            return response()->json([
                'success'=> true,
                'message'=> 'User Account has been created successfully',
            ], 201);

        } catch (ValidationException $e) {
            DB::rollBack();
            return response()->json([
                'success'=> false,
                'message' => 'Validation failed because: '. json_encode($e->errors()),
            ], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success'=> false,
                'message' => 'An error occurred: ' . json_encode($e->getMessage()),
            ], 500);
        }
    }

    public function createUser(Request $request)
    {
        $tokens = $request->bearerToken();

        DB::beginTransaction();

        try {
            $data = $request->validate([
                'name' => ['required', 'string'],
                'email' => ['required', 'email', 'unique:users'],
                'password' => ['required', 'min:6'],
                'dob' => ['required', 'string'],
                'gender' => ['required', 'string'],
                'phone' => ['required', 'string'],
                'image' => ['required', 'string'],
            ]);

            $user = User::create($data);
            $token = $user->createToken('auth_token')->plainTextToken;

            // Generate encryption key
            $firstChar = substr($data['name'], 0, 1);
            $lastChar = substr($data['name'], -1);
            $randomNumbers = str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);
            $encryptionKey = $firstChar . $lastChar . '-' . $randomNumbers;

            $iv = Str::random(8);

            // Encrypt the token with OpenSSL using DES
            $encryptedToken = openssl_encrypt($token, 'des-cbc', $encryptionKey, 0, $iv);
            $encryptedToken = base64_encode($iv . $encryptedToken);

            // Save to user_api_tokens table
            UserApiToken::create([
                'user_id' => $user->id,
                'raw_token' => $token,
                'hash_token' => $encryptedToken,
                'user_key' => $encryptionKey
            ]);

            DB::commit();

            return response()->json([
                'success'=> true,
                'message'=> 'User Account has been created successfully',
                'apikey' => $encryptedToken,
                'user' => $user,
            ], 201);

        } catch (ValidationException $e) {
            DB::rollBack();
            return response()->json([
                'success'=> false,
                'message' => 'Validation failed because: '. json_encode($e->errors()),
            ], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success'=> false,
                'message' => 'An error occurred: ' . json_encode($e->getMessage()),
            ], 500);
        }
    }

    public function updateUser(Request $request)
    {
        $user = User::find($request->id);
        if ($user) {
            $user->update($request->only(['name', 'email', 'password']));
            return response()->json($user);
        }
        return response()->json(['error' => 'User not found'], 404);
    }

    public function destroyUser(Request $request)
    {
        $user = User::find($request->id);
        if ($user) {
            $user->delete();
            return response()->json(['message' => 'User deleted']);
        }
        return response()->json(['error' => 'User not found'], 404);
    }

    public function sortUser()
    {
        $users = User::orderBy('name')->get();
        return response()->json($users);
    }

    // User OTP Tokens
    public function viewUserOTPToken()
    {
        $otpTokens = UserOTPToken::all();
        return response()->json($otpTokens);
    }

    public function createUserOTPToken(Request $request)
    {
        $otpToken = UserOTPToken::create($request->only(['user_id', 'token']));
        return response()->json($otpToken, 201);
    }

    public function updateUserOTPToken(Request $request)
    {
        $otpToken = UserOTPToken::find($request->id);
        if ($otpToken) {
            $otpToken->update($request->only(['user_id', 'token']));
            return response()->json($otpToken);
        }
        return response()->json(['error' => 'OTP Token not found'], 404);
    }

    public function destroyUserOTPToken(Request $request)
    {
        $otpToken = UserOTPToken::find($request->id);
        if ($otpToken) {
            $otpToken->delete();
            return response()->json(['message' => 'OTP Token deleted']);
        }
        return response()->json(['error' => 'OTP Token not found'], 404);
    }

    public function sortUserOTPToken()
    {
        $otpTokens = UserOTPToken::orderBy('user_id')->get();
        return response()->json($otpTokens);
    }

    // User API Tokens
    public function viewUserAPIToken()
    {
        $apiTokens = UserAPIToken::all();
        return response()->json($apiTokens);
    }

    public function createUserAPIToken(Request $request)
    {
        $apiToken = UserAPIToken::create($request->only(['user_id', 'token']));
        return response()->json($apiToken, 201);
    }

    public function updateUserAPIToken(Request $request)
    {
        $apiToken = UserAPIToken::find($request->id);
        if ($apiToken) {
            $apiToken->update($request->only(['user_id', 'token']));
            return response()->json($apiToken);
        }
        return response()->json(['error' => 'API Token not found'], 404);
    }

    public function destroyUserAPIToken(Request $request)
    {
        $apiToken = UserAPIToken::find($request->id);
        if ($apiToken) {
            $apiToken->delete();
            return response()->json(['message' => 'API Token deleted']);
        }
        return response()->json(['error' => 'API Token not found'], 404);
    }

    public function sortUserAPIToken()
    {
        $apiTokens = UserAPIToken::orderBy('user_id')->get();
        return response()->json($apiTokens);
    }
}
