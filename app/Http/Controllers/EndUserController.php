<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\UserApiToken;
use App\Models\UserOTPToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;


class EndUserController extends Controller
{
    // Users
    public function viewUser()
    {
        // Code to handle viewing users
    }

    //Open route to create user
    public function register(Request $request)
    {
        DB::beginTransaction();

        try {

            $validator = Validator::make($request->all(), [
                'phone' => ['required', 'string'],
                'name' => ['required', 'string', 'min:10'],
                'nickname' => ['required', 'string', 'max:15'],
                'email' => ['required', 'email', 'unique:users'],
                'password' => ['required', 'min:6'],
                'gender' => ['required', 'string'],
                'dob' => ['required', 'date'],
                'role_id' => ['required', 'integer', 'exists:roles,id'],
                'fear' => ['required', 'string'],
                'address' => ['required', 'string'],
                'image' => 'required|image|mimes:png,jpg,jpeg,gif',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed because: ' . json_encode($validator->errors()),
                ], 422);
            }

            $data = $request->all();

            // Handle file upload
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $firstChar = substr($data['name'], 0, 1);
                $lastChar = substr($data['name'], -1);
                $filename = $firstChar . $lastChar . '-'. $data['phone'];
                $data['image'] = $filename . '.png';
            }

            $data['password'] = Hash::make($data['password']);
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

            $filePath = $file->storeAs('public/images/users', $filename. '.png');

            return response()->json([
                'success' => true,
                'message' => 'User Account has been created successfully',
            ], 201);
        } catch (ValidationException $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Validation failed because: ' . json_encode($e->errors()),
            ], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'An error occurred: ' . json_encode($e->getMessage()),
            ], 500);
        }
    }

    // Creating account for mobile users
    public function mobileRequestAccount(Request $request)
    {
        DB::beginTransaction();

        try {

            $validator = Validator::make($request->all(), [
                'phone' => ['required', 'string'],
                'name' => ['required', 'string', 'min:10'],
                'nickname' => ['required', 'string', 'max:15'],
                'email' => ['required', 'email'],
                'password' => ['required', 'min:6'],
                'gender' => ['required', 'string'],
                'dob' => ['required', 'date'],
                'address' => ['required', 'string'],
                // 'image' => 'required|image|mimes:png,jpg,jpeg,gif',
                'image' => 'required|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed because: ' . json_encode($validator->errors()),
                ], 422);
            }

            $data = $request->all();
            // Check if the phone or email exists
            if (User::where('phone', $request->phone)->orWhere('email', $request->email)->exists()) {
                $message = '';

                if (User::where('phone', $request->phone)->exists()) {
                    $message = 'Phone number has already been taken. Please use a different one.';
                } elseif (User::where('email', $request->email)->exists()) {
                    $message = 'Email has already been taken. Please use a different one.';
                }

                return response()->json([
                    'success' => false,
                    'message' => $message
                ], 422);
            }

            if (!empty($data['image'])) {
                $image = $data['image'];
                $lastFourDigits = substr($data['phone'], -4);
                $filename = $data['nickname'] .'-'. $lastFourDigits;
                $imagePath = storage_path('/images/users/' . $filename . '.png');

                // Decode base64 string and save to file
                $imageData = base64_decode($image);
                file_put_contents($imagePath, $imageData);
                $data['image'] = $filename . '.png';
            }

            $data['password'] = Hash::make($data['password']);
            $privateRole = Role::where('title', 'Private')->first();
            if ($privateRole) {
                $data['role_id'] = $privateRole->id;
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Please try again in the next few minutes, server down',
                ], 400);
            }
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
                'success' => true,
                'message' => 'User Account has been created successfully',
            ], 201);
        } catch (ValidationException $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Validation failed because: ' . json_encode($e->errors()),
            ], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'An error occurred: ' . json_encode($e->getMessage()),
            ], 500);
        }
    }


    // Creating Account when authenticated from the web
    public function createUser(Request $request)
    {
        $tokens = $request->bearerToken();

        DB::beginTransaction();

        try {

            $validator = Validator::make($request->all(), [
                'phone' => ['required', 'string'],
                'name' => ['required', 'string', 'min:10'],
                'nickname' => ['required', 'string', 'max:15'],
                'email' => ['required', 'email', 'unique:users'],
                'password' => ['required', 'min:6'],
                'gender' => ['required', 'string'],
                'dob' => ['required', 'date'],
                'role_id' => ['required', 'integer', 'exists:roles,id'],
                'fear' => ['required', 'string'],
                'address' => ['required', 'string'],
                'image' => 'required|image|mimes:png,jpg,jpeg,gif',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed because: ' . json_encode($validator->errors()),
                ], 422);
            }

            $data = $request->all();

            // Handle file upload
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $firstChar = substr($data['name'], 0, 1);
                $lastChar = substr($data['name'], -1);
                $filename = $firstChar . $lastChar . '-'. $data['phone'];
                $data['image'] = $filename . '.png';
            }

            $data['password'] = Hash::make($data['password']);
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
            
            $filePath = $file->storeAs('/images/users', $filename. '.png');

            return response()->json([
                'success' => true,
                'message' => 'User Account has been created successfully',
            ], 201);
        } catch (ValidationException $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Validation failed because: ' . json_encode($e->errors()),
            ], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'An error occurred: ' . json_encode($e->getMessage()),
            ], 500);
        }
    }

    public function updateUser(Request $request)
    {
        // Code to handle updating a user
    }

    public function destroyUser(Request $request)
    {
        // Code to handle deleting a user
    }

    public function getUser(Request $request)
    {
        // Code to handle getting a user
    }

    // User OTP Tokens
    public function viewUserOTPToken()
    {
        // Code to handle viewing user OTP tokens
    }

    public function createUserOTPToken(Request $request)
    {
        // Code to handle creating a user OTP token
    }

    public function updateUserOTPToken(Request $request)
    {
        // Code to handle updating a user OTP token
    }

    public function destroyUserOTPToken(Request $request)
    {
        // Code to handle deleting a user OTP token
    }

    public function getUserOTPToken(Request $request)
    {
        // Code to handle getting a user OTP token
    }

    // User API Tokens
    public function viewUserAPIToken()
    {
        // Code to handle viewing user API tokens
    }

    public function createUserAPIToken(Request $request)
    {
        // Code to handle creating a user API token
    }

    public function updateUserAPIToken(Request $request)
    {
        // Code to handle updating a user API token
    }

    public function destroyUserAPIToken(Request $request)
    {
        // Code to handle deleting a user API token
    }

    public function getUserAPIToken(Request $request)
    {
        // Code to handle getting a user API token
    }
}
