<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class WebAuthenticationController extends Controller
{
    //

    // POST TO API universal function
    public function handleApiRequest($endpoint, $method, $body)
    {
        $apiStartPoint = env('API_START_POINT');
        $apiURL = $apiStartPoint . $endpoint;

        try {
            $customRequest = Request::create($apiURL, $method, $body);
            $customRequest->headers->set('Accept', 'application/json');

            $response = app()->handle($customRequest);
            $data = json_decode($response->getContent(), true);

            return response()->json([
                'success' => $response->getStatusCode() === 200,
                'message' => $data['message'] ?? ($response->getStatusCode() === 200 ? 'Success' : 'Failed'),
                'data' => $data['data'] ?? [],
                'errors' => $data['errors'] ?? [],
            ], $response->getStatusCode());
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred: ' . $e->getMessage()
            ], 500);
        }
    }

    //Inserting into sessions
    public function insertSessionApiRequest($endpoint, $method, $body)
    {
        $apiStartPoint = env('API_START_POINT');
        $apiURL = $apiStartPoint . $endpoint;

        try {
            $customRequest = Request::create($apiURL, $method, $body);
            $customRequest->headers->set('Accept', 'application/json');

            $response = app()->handle($customRequest);
            $data = json_decode($response->getContent(), true);
            Log::info('Coming Error: ' . json_encode($data));

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

    // Sending the action request
    public function signin(Request $request)
    {
        // Validate the request inputs
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|min:10',
            'password' => 'required|string|min:6',
            'country' => 'required|string',
            'ip' => 'required|string',
            'os' => 'required|string',
            'browser' => 'required|string',
        ]);

        if ($validator->fails()) {
            Log::error('Validation failed', ['message' => $validator->errors()]);
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }

        $data = $request->all();
        // dd('Available data: ' . json_encode($data));

        $endpoint1 = '/authentication/login';
        $method = 'GET';
        $body = [
            'email' => $data['email'],
            'password' => $data['password'],
        ];

        // Initial login request
        $loginResponse = $this->handleApiRequest($endpoint1, $method, $body);
        $loginData = json_decode($loginResponse->getContent(), true);

        // Log::info('Login response', ['response' => $loginData]);

        if ($loginResponse->getStatusCode() === 200 && $loginData['success']) {

            $usergoingID = (string) $loginData['data']['user_id'];

            // Prepare the remaining data to be inserted
            $endpoint2 = '/authentication/sessions';
            $method = 'POST';
            $body = [
                'country' => $data['country'],
                'ip' => $data['ip'],
                'os' => $data['os'],
                'browser' => $data['browser'],
                'user_id' => $usergoingID
            ];

            // Insert session data
            $insertResponse = $this->insertSessionApiRequest($endpoint2, $method, $body);
            $insertData = json_decode($insertResponse->getContent(), true);

            if ($insertResponse->getStatusCode() === 201 && $insertData['success']) {

                // Get batch and dashboard route
                $roles = (string) $loginData['data']['role'];

                $batch = $this->getBatchAndDashboardRoute($roles);

                // Store session data
                $this->storeSessionData($loginData['data'], $batch['batch']);

                return response()->json([
                    'success' => true,
                    'redirect' => route($batch['dashboardRoute'])
                ]);
            } else {
                return $insertResponse;
            }
        } else {
            return $loginResponse;
        }
    }

    // Reaching out to the routes based on the role
    private function getBatchAndDashboardRoute($role)
    {
        $batch = '';
        $dashboardRoute = '';

        if (in_array($role, ['Developer', 'Oversear', 'Kernel'])) {
            $batch = 'skaimount';
            $dashboardRoute = 'management.dashboard';
        } elseif (in_array($role, ['Author', 'Event Manager', 'State Director'])) {
            $batch = 'skaiclient';
            $dashboardRoute = 'client.dashboard';
        }

        return ['batch' => $batch, 'dashboardRoute' => $dashboardRoute];
    }

    // Store the session values
    private function storeSessionData($responseData, $batch)
    {
        session([
            'token' => $responseData['token'],
            'api_token' => $responseData['api_token'],
            'user_key' => $responseData['user_key'],
            'api_key' => $responseData['api_key'],
            'batch' => $batch,
            'user_id' => $responseData['user_id'],
            'name' => $responseData['name'],
            'nickname' => $responseData['nickname'],
            'email' => $responseData['email'],
            'phone' => $responseData['phone'],
            'image' => $responseData['image'],
            'role' => $responseData['role'],
            'host' => $responseData['host'],
        ]);
    }

    // Setting the login page to view
    public function login()
    {

        if (Auth::check() && session()->has('role')) {
            $role = session('role');
            if (in_array($role, ['Developer', 'Oversear', 'Kernel'])) {
                return redirect()->route('management.dashboard');
            } elseif (in_array($role, ['Author', 'Event Manager', 'State Director'])) {
                return redirect()->route('client.dashboard');
            }
        } return view('auth.login');
    }

    // FUNCTION TO LOGOUT
    public function logout()
    {
        $endpoint = '/authentication/logout';
        $method = 'POST';
        $user_id = session('user_id');
        $body = [
            'user_id' => $user_id,
        ];
        $insertResponse = $this->insertSessionApiRequest($endpoint, $method, $body);
        $insertData = json_decode($insertResponse->getContent(), true);
        Log::info('Main Body: ' . json_encode($body));

        if ($insertResponse->getStatusCode() === 201 && $insertData['success']) {
            session()->flush();
            Auth::logout();
            return redirect()->route('login');
        } else {
            return redirect()->route('login');
        }
    }


    public function recover_password()
    {
        return view('auth.recover-password');
    }

    public function verify_email()
    {
        return view('auth.verify-email');
    }

    public function reset_password()
    {
        return view('auth.reset-password');
    }

    public function lock_screen()
    {
        return view('auth.lockscreen');
    }

    public function change_password()
    {
        return view('auth.change-password');
    }
}
