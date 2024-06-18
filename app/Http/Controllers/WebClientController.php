<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebClientController extends Controller
{

    // GET FROM API universal function
    public function getViewDataFromApi($endpoint, $status)
    {
        // Retrieve the values from the session
        $token = session('token');
        $apiKey = session('api_key');
        $apiToken = session('api_token');
        $userKey = session('user_key');

        try {
            $apiStartPoint = env('API_START_POINT');
            $apiURL = $apiStartPoint . $endpoint;

            // Create the GET request
            $customRequest = Request::create($apiURL, 'GET');
            $customRequest->headers->set('Accept', 'application/json');

            // Set headers if tokens are available
            if ($status == "send-with-token") {
                $customRequest->headers->set('Authorization', 'Bearer ' . $token);
                $customRequest->headers->set('ApiKey', $apiKey);
                $customRequest->headers->set('ApiToken', $apiToken);
                $customRequest->headers->set('UserKey', $userKey);
            }

            // Handle the request and get the response
            $response = app()->handle($customRequest);
            $data = json_decode($response->getContent(), true);

            if ($response->getStatusCode() === 200) {
                return [
                    'status' => true,
                    'data' => $data['data'],
                    'message' => 'Data retrieved successfully',
                ];
            } else {
                return [
                    'status' => false,
                    'message' => $data['message'] ?? 'Failed to retrieve data',
                    'data' => $data['errors'] ?? [],
                ];
            }
        } catch (\Exception $e) {
            return [
                'status' => false,
                'message' => 'An error occurred: ' . $e->getMessage(),
                'data' => [],
            ];
        }
    }


    //
    public function dashboard(Request $request)
    {

        $creator_id = session('host');

        $endpoint = '/gen/client/event-statistic';
        $endpoint2 = '/gen/client/personal-events';
        $send_state = "send-with-token";

        $queryParams = [];
        $idata = [];
        $edata = [];

        if (!empty($creator_id)) {
            $queryParams['creator_id'] = $creator_id;
        }

        if (!empty($queryParams)) {
            $endpoint .= '?' . http_build_query($queryParams);
            $endpoint2 .= '?' . http_build_query($queryParams);

            $apiResponse = $this->getViewDataFromApi($endpoint, $send_state);
            $apiResponse2 = $this->getViewDataFromApi($endpoint2, $send_state);
            $idata = $apiResponse['status'] ? $apiResponse['data'] : [];
            $edata = $apiResponse2['status'] ? $apiResponse2['data'] : [];
        }

         // Convert each event array to an object
        $edata = array_map(function($item) {
            return (object) $item;
        }, $edata);

        Log::info('got: ' . json_encode($edata));
        // Log::info('ID : ' .$creator_id);
    
        return view('backend.clients.dashboard', ['info' => $idata ?? [], 'events' => $edata]);
    }
}
