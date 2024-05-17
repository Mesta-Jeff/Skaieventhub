<?php

namespace App\Http\Controllers\web;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

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
            $apiURL = 'http://127.0.0.1:8000/api/v2/user/register';
            $body = [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => $request->input('password'),
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
                    'token' => $data['token'],
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
