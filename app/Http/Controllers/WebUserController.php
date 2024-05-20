<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class WebUserController extends Controller
{
    //

    //  Talking to api route encripted
    public function createUser(Request $request)
    {
        // Validate the request inputs
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            Log::error('Validation failed', ['errors' => $validator->errors()]);
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $apiURL = 'http://127.0.0.1:8000/api/v2/users/add';
            $token = "896ufTBn3K8A1SWjFKLuHZOroZmxXWAT7z2XN7pf0b5a3ddc";
            $body = [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => $request->input('password'),
            ];

            $customRequest = Request::create($apiURL, 'POST', $body);
            $customRequest->headers->set('Accept', 'application/json');
            $customRequest->headers->set('Authorization', 'Bearer ' . $token);
            $customRequest->headers->set('ApiKey', 'your_api_key_here');
            $customRequest->headers->set('UserKey', 'your_user_key_here');

            $response = app()->handle($customRequest);
            $data = json_decode($response->getContent(), true);

            if ($response->getStatusCode() === 201) {
                return response()->json([
                    'success' => true,
                    'message' => $data['message'] ?? 'User created successfully',
                    'token' => $data['token'] ?? null,
                    'data' => $data
                ], 201);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => $data['message'] ?? 'Failed to create user',
                    'data' => $data
                ], $response->getStatusCode());
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred: ' . $e->getMessage()
            ], 500);
        }
    }

    public function freeRoute(Request $request)
    {
        // Validate the request inputs
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:6'],
            'dob' => ['required', 'string'],
            'gender' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'image' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            Log::error('Validation failed', ['errors' => $validator->errors()]);
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $apiURL = '127.0.0.1:8000/api/v2/users/new/registration';
            $body = [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => $request->input('password'),
                'dob' => $request->input('dob'),
                'phone' => $request->input('phone'),
                'image' => $request->input('image'),
                'gender' => $request->input('gender'),
            ];

            $customRequest = Request::create($apiURL, 'POST', $body);
            $customRequest->headers->set('Accept', 'application/json');

            $response = app()->handle($customRequest);
            $data = json_decode($response->getContent(), true);

            if ($response->getStatusCode() === 201) {
                return response()->json([
                    'success' => true,
                    'message' => 'User created successfully',
                    'user' => $data['user'],
                    'token' => $data['apikey'],
                ], 201);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => $data['message'] ?? 'Failed to create user',
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


    public function usersList(Request $request)
    {
        //
        return view('backend.management.user');
    }
}
