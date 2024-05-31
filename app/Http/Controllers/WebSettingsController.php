<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class WebSettingsController extends Controller
{

    // BUlk Rmove
    public function bulkRemove(Request $request)
    {
        try {
            // Retrieve the values from the session
            $token = session('token');
            $apiKey = session('api_key');
            $apiToken = session('api_token');
            $userKey = session('user_key');
            $apiStartPoint = env('API_START_POINT');
            $apiURL = $apiStartPoint . '/commands/bulk-remove';

            // Prepare the request body
            $ids = $request->input('id');
            $table = $request->input('table');
            $body = [
                'ids' => $ids,
                'table' => $table,
            ];

            // Create the custom request
            $customRequest = Request::create($apiURL, 'POST', $body);
            $customRequest->headers->set('Accept', 'application/json');
            $customRequest->headers->set('Authorization', 'Bearer ' . $token);
            $customRequest->headers->set('ApiKey', $apiKey);
            $customRequest->headers->set('ApiToken', $apiToken);
            $customRequest->headers->set('UserKey', $userKey);

            // Handle the request and get the response
            $response = app()->handle($customRequest);
            $data = json_decode($response->getContent(), true);

            // Check the response status code
            if ($response->getStatusCode() === 201) {
                return response()->json([
                    'success' => true,
                    'message' => $data['message'] ?? 'Records Removed',
                ], 201);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => $data['message'] ?? 'Failed to remove records',
                    'errors' => $data['errors'] ?? [],
                ], $response->getStatusCode());
            }
        } catch (\Exception $e) {
            Log::error('Validation failed', ['errors' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'An error occurred: ' . $e->getMessage()
            ], 500);
        }
    }

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

    // Getting record by id
    public function getDataFromApiById($endpoint, $status)
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

    // POST TO API universal function
    public function handleApiRequest($endpoint, $method, $body, $status)
    {
        // Retrieve the values from the session
        $token = session('token');
        $apiKey = session('api_key');
        $apiToken = session('api_token');
        $userKey = session('user_key');

        // Build the full API URL
        $apiStartPoint = env('API_START_POINT');
        $apiURL = $apiStartPoint . $endpoint;

        try {
            // Create the request
            $customRequest = Request::create($apiURL, $method, $body);
            $customRequest->headers->set('Accept', 'application/json');

            // Add headers if status requires a token
            if ($status == "send-with-token") {
                $customRequest->headers->set('Authorization', 'Bearer ' . $token);
                $customRequest->headers->set('ApiKey', $apiKey);
                $customRequest->headers->set('ApiToken', $apiToken);
                $customRequest->headers->set('UserKey', $userKey);
            }

            // Handle the request and get the response
            $response = app()->handle($customRequest);
            $data = json_decode($response->getContent(), true);

            // Check the response status code
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
            // Return a JSON response with error details
            return response()->json([
                'success' => false,
                'message' => 'An error occurred: ' . $e->getMessage()
            ], 500);
        }
    }

    // Roles
    public function showRole(Request $request)
    {
        $endpoint = '/settings/roles';
        $send_state = "free";
        $apiResponse = $this->getViewDataFromApi($endpoint, $send_state);
        $idata = $apiResponse['status'] ? $apiResponse['data'] : [];
        if ($request->ajax()) {
            return response()->json(['roles' => $idata]);
        }
        return view('backend.settings.roles', ['roles' => $idata]);
    }

    public function addRole(Request $request)
    {
        // Validate the request inputs
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:30',
            'description' => 'required|string|max:1000',
        ]);

        if ($validator->fails()) {
            Log::error('Validation failed', ['message' => $validator->errors()]);
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }

        $endpoint = '/settings/roles';
        $method = 'POST';
        $body = [
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ];
        $sending_status = "free";
        return $this->handleApiRequest($endpoint, $method, $body, $sending_status);
    }

    public function modifyRole(Request $request)
    {
        // Validate the request inputs
        $validator = Validator::make($request->all(), [
            'role_id' => ['required', 'numeric'],
            'title' => 'required|string|max:30',
            'description' => 'required|string|max:1000',
            'status' => 'required|string|max:10',
        ]);

        if ($validator->fails()) {
            Log::error('Validation failed', ['message' => $validator->errors()]);
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }

        $endpoint = '/settings/roles/update';
        $method = 'POST';
        $body = [
            'role_id' => $request->input('role_id'),
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'status' => $request->input('status'),
        ];
        $sending_status = "send-with-token";
        return $this->handleApiRequest($endpoint, $method, $body, $sending_status);
    }

    public function removeRole(Request $request)
    {
        // Validate the request inputs
        $validator = Validator::make($request->all(), [
            'role_id' => ['required', 'numeric'],
        ]);

        if ($validator->fails()) {
            Log::error('Validation failed', ['message' => $validator->errors()]);
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }

        $endpoint = '/settings/roles/delete';
        $method = 'POST';
        $body = [
            'role_id' => $request->input('role_id'),
        ];

        $sending_status = "send-with-token";
        return $this->handleApiRequest($endpoint, $method, $body, $sending_status);
    }

    public function fetchRole(Request $request){

        $endpoint = '/settings/roles/fetch';
        $send_state = "free";
        $apiResponse = $this->getViewDataFromApi($endpoint, $send_state);
        $idata = $apiResponse['status'] ? $apiResponse['data'] : [];

        if ($request->ajax()) {
            return response()->json(['roles' => $idata]);
        }
    }

    // Regions
    public function showRegion(Request $request)
    {
        $endpoint = '/settings/regions';
        $send_state = "send-with-token";
        $apiResponse = $this->getViewDataFromApi($endpoint, $send_state);
        $idata = $apiResponse['status'] ? $apiResponse['data'] : [];
        if ($request->ajax()) {
            return response()->json(['regions' => $idata]);
        }
        return view('backend.settings.regions', ['regions' => $idata]);
    }

    public function addRegion(Request $request)
    {
        // Validate the request inputs
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
        ]);

        if ($validator->fails()) {
            Log::error('Validation failed', ['message' => $validator->errors()]);
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }

        $endpoint = '/settings/regions';
        $method = 'POST';
        $body = [
            'name' => $request->input('name'),
        ];
        $sending_status = "send-with-token";
        return $this->handleApiRequest($endpoint, $method, $body, $sending_status);
    }

    public function modifyRegion(Request $request)
    {
        // Validate the request inputs
        $validator = Validator::make($request->all(), [
            'region_id' => ['required', 'numeric'],
            'name' => 'required|string',
            'status' => 'required|string|max:10',
        ]);

        if ($validator->fails()) {
            Log::error('Validation failed', ['message' => $validator->errors()]);
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }

        $endpoint = '/settings/regions/update';
        $method = 'POST';
        $body = [
            'region_id' => $request->input('region_id'),
            'name' => $request->input('name'),
            'status' => $request->input('status'),
        ];
        $sending_status = "send-with-token";
        return $this->handleApiRequest($endpoint, $method, $body, $sending_status);
    }

    public function removeRegion(Request $request)
    {
        // Validate the request inputs
        $validator = Validator::make($request->all(), [
            'region_id' => ['required', 'numeric'],
        ]);

        if ($validator->fails()) {
            Log::error('Validation failed', ['message' => $validator->errors()]);
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }

        $endpoint = '/settings/regions/delete';
        $method = 'POST';
        $body = [
            'region_id' => $request->input('region_id'),
        ];

        $sending_status = "send-with-token";
        return $this->handleApiRequest($endpoint, $method, $body, $sending_status);
    }

    public function getRegion(Request $request)
    {
        $endpoint = '/settings/regions/get';
        $send_state = "send-with-token";
        $apiResponse = $this->getViewDataFromApi($endpoint, $send_state);
        $idata = $apiResponse['status'] ? $apiResponse['data'] : [];

        if ($request->ajax()) {
            return response()->json(['regions' => $idata]);
        }
    }

    // Districts
    public function showDistrict(Request $request)
    {
        $endpoint = '/settings/districts';
        $send_state = "send-with-token";
        $apiResponse = $this->getViewDataFromApi($endpoint, $send_state);
        $idata = $apiResponse['status'] ? $apiResponse['data'] : [];
        if ($request->ajax()) {
            return response()->json(['districts' => $idata]);
        }
        return view('backend.settings.districts', ['districts' =>$idata]);
    }

    public function addDistrict(Request $request)
    {
        // Validate the request inputs
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'region_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            Log::error('Validation failed', ['message' => $validator->errors()]);
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }

        $endpoint = '/settings/districts';
        $method = 'POST';
        $body = [
            'name' => $request->input('name'),
            'region_id' => $request->input('region_id'),
        ];
        $sending_status = "send-with-token";
        return $this->handleApiRequest($endpoint, $method, $body, $sending_status);
    }

    public function modifyDistrict(Request $request)
    {
        // Validate the request inputs
        $validator = Validator::make($request->all(), [
            'region_id' => ['required', 'numeric'],
            'district_id' => ['required', 'numeric'],
            'name' => 'required|string',
            'status' => 'required|string|max:10',
        ]);

        if ($validator->fails()) {
            Log::error('Validation failed', ['message' => $validator->errors()]);
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }

        $endpoint = '/settings/districts/update';
        $method = 'POST';
        $body = [
            'region_id' => $request->input('region_id'),
            'district_id' => $request->input('district_id'),
            'name' => $request->input('name'),
            'status' => $request->input('status'),
        ];
        $sending_status = "send-with-token";
        return $this->handleApiRequest($endpoint, $method, $body, $sending_status);
    }

    public function removeDistrict(Request $request)
    {
        // Validate the request inputs
        $validator = Validator::make($request->all(), [
            'district_id' => ['required', 'numeric'],
        ]);

        if ($validator->fails()) {
            Log::error('Validation failed', ['message' => $validator->errors()]);
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }

        $endpoint = '/settings/districts/delete';
        $method = 'POST';
        $body = [
            'district_id' => $request->input('district_id'),
        ];

        $sending_status = "send-with-token";
        return $this->handleApiRequest($endpoint, $method, $body, $sending_status);
    }

    public function getDistrict(Request $request)
    {
        $endpoint = '/settings/districts/get';
        $send_state = "send-with-token";
        $apiResponse = $this->getViewDataFromApi($endpoint, $send_state);
        $idata = $apiResponse['status'] ? $apiResponse['data'] : [];

        if ($request->ajax()) {
            return response()->json(['districts' => $idata]);
        }
    }

    public function getDistrictByRegion(Request $request)
    {
        $region_id = $request->input('region_id');
        $endpoint = '/settings/districts/byRegion';
        $send_state = "send-with-token";

        $endpoint .= '?region_id=' . $region_id;

        $apiResponse = $this->getDataFromApiById($endpoint, $send_state);
        $idata = $apiResponse['status'] ? $apiResponse['data'] : [];

        if ($request->ajax()) {
            return response()->json(['filtered' => $idata]);
        }
    }


    // Towns
    public function showTown(Request $request)
    {
        $endpoint = '/settings/towns';
        $send_state = "send-with-token";
        $apiResponse = $this->getViewDataFromApi($endpoint, $send_state);
        $idata = $apiResponse['status'] ? $apiResponse['data'] : [];
        if ($request->ajax()) {
            return response()->json(['towns' => $idata]);
        }
        return view('backend.settings.towns', ['towns' =>$idata]);
    }

    public function addTown(Request $request)
    {
        // Validate the request inputs
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'district_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            Log::error('Validation failed', ['message' => $validator->errors()]);
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }

        $endpoint = '/settings/towns';
        $method = 'POST';
        $body = [
            'name' => $request->input('name'),
            'district_id' => $request->input('district_id'),
        ];
        $sending_status = "free";
        return $this->handleApiRequest($endpoint, $method, $body, $sending_status);
    }

    public function modifyTown(Request $request)
    {
        // Validate the request inputs
        $validator = Validator::make($request->all(), [
            'town_id' => ['required', 'numeric'],
            'district_id' => ['required', 'numeric'],
            'name' => 'required|string',
            'status' => 'required|string|max:10',
        ]);

        if ($validator->fails()) {
            Log::error('Validation failed', ['message' => $validator->errors()]);
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }

        $endpoint = '/settings/towns/update';
        $method = 'POST';
        $body = [
            'town_id' => $request->input('town_id'),
            'district_id' => $request->input('district_id'),
            'name' => $request->input('name'),
            'status' => $request->input('status'),
        ];
        $sending_status = "send-with-token";
        return $this->handleApiRequest($endpoint, $method, $body, $sending_status);
    }

    public function removeTown(Request $request)
    {
        // Validate the request inputs
        $validator = Validator::make($request->all(), [
            'town_id' => ['required', 'numeric'],
        ]);

        if ($validator->fails()) {
            Log::error('Validation failed', ['message' => $validator->errors()]);
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }

        $endpoint = '/settings/towns/delete';
        $method = 'POST';
        $body = [
            'town_id' => $request->input('town_id'),
        ];

        $sending_status = "send-with-token";
        return $this->handleApiRequest($endpoint, $method, $body, $sending_status);
    }

    public function getTown(Request $request)
    {
        $endpoint = '/settings/towns/get';
        $send_state = "send-with-token";
        $apiResponse = $this->getViewDataFromApi($endpoint, $send_state);
        $idata = $apiResponse['status'] ? $apiResponse['data'] : [];

        if ($request->ajax()) {
            return response()->json(['towns' => $idata]);
        }
    }

    public function getTownByDistrict(Request $request)
    {
        $district_id = $request->input('district_id');
        $endpoint = '/settings/towns/byDistrict';
        $send_state = "send-with-token";

        $endpoint .= '?district_id=' . $district_id;

        $apiResponse = $this->getDataFromApiById($endpoint, $send_state);
        $idata = $apiResponse['status'] ? $apiResponse['data'] : [];

        if ($request->ajax()) {
            return response()->json(['filtered' => $idata]);
        }
    }


    // Permissions
    public function showPermission()
    {
        return view('backend.settings.permissions');
    }

    public function addPermission(Request $request)
    {
        // Code to handle adding a permission
    }

    public function modifyPermission(Request $request)
    {
        // Code to handle modifying a permission
    }

    public function removePermission(Request $request)
    {
        // Code to handle removing a permission
    }

    public function getPermission(Request $request)
    {
        // Code to handle getting a permission
    }

    // User Permissions
    public function showUserPermission()
    {
        // Code to handle showing user permissions
    }

    public function addUserPermission(Request $request)
    {
        // Code to handle adding a user permission
    }

    public function modifyUserPermission(Request $request)
    {
        // Code to handle modifying a user permission
    }

    public function removeUserPermission(Request $request)
    {
        // Code to handle removing a user permission
    }

    public function getUserPermission(Request $request)
    {
        // Code to handle getting a user permission
    }

    // Identity Types
    public function showIdentityType(Request $request)
    {
        $endpoint = '/settings/identity-types';
        $send_state = "send-with-token";
        $apiResponse = $this->getViewDataFromApi($endpoint, $send_state);
        $idata = $apiResponse['status'] ? $apiResponse['data'] : [];
        if ($request->ajax()) {
            return response()->json(['identitytypes' => $idata]);
        }
        return view('backend.settings.identity-types', ['identitytypes' => $idata]);
    }

    public function addIdentityType(Request $request)
    {
        // Validate the request inputs
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
        ]);

        if ($validator->fails()) {
            Log::error('Validation failed', ['message' => $validator->errors()]);
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }

        $endpoint = '/settings/identity-types';
        $method = 'POST';
        $body = [
            'name' => $request->input('name'),
        ];
        $sending_status = "send-with-token";
        return $this->handleApiRequest($endpoint, $method, $body, $sending_status);
    }

    public function modifyIdentityType(Request $request)
    {
       // Validate the request inputs
       $validator = Validator::make($request->all(), [
            'identitytype_id' => ['required', 'numeric'],
            'name' => 'required|string',
            'status' => 'required|string|max:10',
        ]);

        if ($validator->fails()) {
            Log::error('Validation failed', ['message' => $validator->errors()]);
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }

        $endpoint = '/settings/identity-types/update';
        $method = 'POST';
        $body = [
            'identitytype_id' => $request->input('identitytype_id'),
            'name' => $request->input('name'),
            'status' => $request->input('status'),
        ];
        $sending_status = "send-with-token";
        return $this->handleApiRequest($endpoint, $method, $body, $sending_status);
    }

    public function removeIdentityType(Request $request)
    {
        // Validate the request inputs
        $validator = Validator::make($request->all(), [
            'identitytype_id' => ['required', 'numeric'],
        ]);

        if ($validator->fails()) {
            Log::error('Validation failed', ['message' => $validator->errors()]);
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }

        $endpoint = '/settings/identity-types/delete';
        $method = 'POST';
        $body = [
            'identitytype_id' => $request->input('identitytype_id'),
        ];

        $sending_status = "send-with-token";
        return $this->handleApiRequest($endpoint, $method, $body, $sending_status);
    }

    public function getIdentityType(Request $request)
    {
        $endpoint = '/settings/identity-types/get';
        $send_state = "free";
        $apiResponse = $this->getViewDataFromApi($endpoint, $send_state);
        $idata = $apiResponse['status'] ? $apiResponse['data'] : [];

        if ($request->ajax()) {
            return response()->json(['identities' => $idata]);
        }
    }

    // API Routes
    public function showAPIRoute()
    {
        // Code to handle showing API routes
    }

    public function addAPIRoute(Request $request)
    {
        // Code to handle adding an API route
    }

    public function modifyAPIRoute(Request $request)
    {
        // Code to handle modifying an API route
    }

    public function removeAPIRoute(Request $request)
    {
        // Code to handle removing an API route
    }

    public function getAPIRoute(Request $request)
    {
        // Code to handle getting an API route
    }

    // Notifications
    public function showNotification()
    {
        // Code to handle showing notifications
    }

    public function addNotification(Request $request)
    {
        // Code to handle adding a notification
    }

    public function modifyNotification(Request $request)
    {
        // Code to handle modifying a notification
    }

    public function removeNotification(Request $request)
    {
        // Code to handle removing a notification
    }

    public function getNotification(Request $request)
    {
        // Code to handle getting a notification
    }
}
