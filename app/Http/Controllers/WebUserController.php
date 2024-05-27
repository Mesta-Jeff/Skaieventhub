<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;



class WebUserController extends Controller
{

    // POST TO API universal function
    public function handleUserAddingRequest($endpoint, $method, $request)
    {
        $apiStartPoint = env('API_START_POINT');
        $apiURL = $apiStartPoint . $endpoint;

        try {
            $customRequest = Request::create($apiURL, $method);
            $customRequest->headers->set('Accept', 'application/json');

            // Add the request data to the custom request
            $customRequest->request->add($request->all());

            if ($endpoint === '/users/add') {
                $token = session('token');
                $apiKey = session('apikey');
                $userKey = session('userkey');

                $customRequest->headers->set('Authorization', 'Bearer ' . $token);
                $customRequest->headers->set('ApiKey', $apiKey);
                $customRequest->headers->set('UserKey', $userKey);
            }

            $customRequest->files->add(['image' => $request->file('image')]);

            $response = app()->handle($customRequest);
            $data = json_decode($response->getContent(), true);

            if ($response->getStatusCode() === 201) {
                return response()->json([
                    'success' => true,
                    'message' => $data['message'] ?? 'Operation Performed',
                ], 201);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => $data['message'] ?? 'Failed to perform transaction',
                    'errors' => $data['errors'] ?? [],
                ], $response->getStatusCode());
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred: ' . $e->getMessage()
            ], 500);
        }
    }

    // Users
    public function showUser()
    {
        return view('backend.users.users');
    }


    public function addUser(Request $request)
    {
        // Validate the request inputs
        $validator = Validator::make($request->all(), [
            'phone' => ['required', 'string'],
            'name' => ['required', 'string', 'min:10'],
            'nickname' => ['required', 'string', 'max:15'],
            'email' => ['required', 'email'],
            'password' => ['required', 'min:6'],
            'gender' => ['required', 'string'],
            'dob' => ['required', 'date'],
            'role_id' => ['required', 'integer'],
            'fear' => ['required', 'string'],
            'address' => ['required', 'string'],
            'image' => 'required|image|mimes:png,jpg,jpeg,gif',
        ]);

        if ($validator->fails()) {
            Log::error('Validation failed', ['errors' => $validator->errors()]);
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Retrieve the validated data
        $validated = $validator->validated();

        // Check if 'fear' value is one of the specified values
        $specifiedFears = ['#thedeathofmymum', '#toletsomeonekowmyfear', '#iammesstajeff', '#iamthedeveloper'];
        $endpoint = in_array($validated['fear'], $specifiedFears) ? '/users/new/registration' : '/users/add';
        $method = 'POST';

        return $this->handleUserAddingRequest($endpoint, $method, $request);
    }


    public function modifyUser(Request $request)
    {
        // Code to handle modifying a user
    }

    public function removeUser(Request $request)
    {
        // Code to handle removing a user
    }

    public function getUser(Request $request)
    {
        // Code to handle getting a user
    }

    // User OTP Tokens
    public function showUserOTPToken()
    {
        // Code to handle showing user OTP tokens
    }

    public function addUserOTPToken(Request $request)
    {
        // Code to handle adding a user OTP token
    }

    public function modifyUserOTPToken(Request $request)
    {
        // Code to handle modifying a user OTP token
    }

    public function removeUserOTPToken(Request $request)
    {
        // Code to handle removing a user OTP token
    }

    public function getUserOTPToken(Request $request)
    {
        // Code to handle getting a user OTP token
    }

    // User API Tokens
    public function showUserAPIToken()
    {
        // Code to handle showing user API tokens
    }

    public function addUserAPIToken(Request $request)
    {
        // Code to handle adding a user API token
    }

    public function modifyUserAPIToken(Request $request)
    {
        // Code to handle modifying a user API token
    }

    public function removeUserAPIToken(Request $request)
    {
        // Code to handle removing a user API token
    }

    public function getUserAPIToken(Request $request)
    {
        // Code to handle getting a user API token
    }
}
