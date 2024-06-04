<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

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
                ->where('users.status', 'Active')
                ->select('users.id','users.name','users.nickname', 'users.email', 'users.phone', 'users.image', 'r.title as role', 'uat.raw_token', 'uat.user_key', 'uat.hash_token')
                ->first();

            // Prepare response data
            $imageUrl = asset('storage/images/users/' . $user->image);
            $token = $user->createToken('auth_token')->plainTextToken;

            $responseData = [
                'user_id' => $user->id,
                'name' => $user->name,
                'nickname' => $user->nickname,
                'email' => $user->email,
                'phone' => $user->phone,
                'image' => $imageUrl,
                'role' => $user->role,
                'api_token' => $user->raw_token,
                'user_key' => $user->user_key,
                'api_key' => $user->hash_token,
                'token' => $token,
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

    public function createSessions(Request $request) {
        try {
            // Validate incoming request data
            $data = $request->validate([
                'country' => 'required|string',
                'user_id' => 'required|string',
                'ip' => 'required|string',
                'os' => 'required|string',
                'browser' => 'required|string',
            ]);

            // Generate missing data
            $id = substr((string) Str::uuid(), 0, 15). '_' . $data['user_id'];
            $user_id = auth()->id() ?? null;
            $date = now()->toDateString();
            $time_in = now()->format('H:i:s');
            $user_agent = $data['os'] . ' ' . $data['browser'] . ' | ' . $data['country'];
            $payload = ''; // Set this according to your needs
            $last_activity = now()->timestamp;

            // Insert data into the sessions table
            $dbRequest = DB::table('sessions')->insert([
                'id' => $id,
                'user_id' => $user_id,
                'date' => $date,
                'time_in' => $time_in,
                'ip_address' => $data['ip'],
                'user_agent' => $user_agent,
                'payload' => $payload,
                'last_activity' => $last_activity,
            ]);

            // Respond based on the success of the insert operation
            if ($dbRequest) {
                return response()->json([
                    'success' => true,
                    'message' => 'Request to perform database operation has gone through successfully',
                ], 201);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Sorry, request to the database has declined, try again later',
                ], 409);
            }
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed because: ' . json_encode($e->errors()),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred: ' . json_encode($e->getMessage()),
            ], 500);
        }
    }


}
