<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class WebSettingsController extends Controller
{
    // GET FROM API universal function
    public function getViewDataFromApi($endpoint)
    {
        try {
            $apiStartPoint = env('API_START_POINT');
            $apiURL = $apiStartPoint . $endpoint;

            // Make the API request
            $customRequest = Request::create($apiURL, 'GET');
            $customRequest->headers->set('Accept', 'application/json');

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

    // FETCH DATA for dropdown
    public function fetchDataFromApiForDropdown($endpoint)
    {
        try {
            $apiStartPoint = env('API_START_POINT');
            $apiURL = $apiStartPoint . $endpoint;

            // Make the API request
            $customRequest = Request::create($apiURL, 'GET');
            $customRequest->headers->set('Accept', 'application/json');

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
    public function handleApiRequest($endpoint, $method, $body)
    {
        $apiStartPoint = env('API_START_POINT');
        $apiURL = $apiStartPoint . $endpoint;

        try {
            $customRequest = Request::create($apiURL, $method, $body);
            $customRequest->headers->set('Accept', 'application/json');

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

    // Roles
    public function showRole(Request $request)
    {
        $endpoint = '/settings/roles';
        $apiResponse = $this->getViewDataFromApi($endpoint);

        $roles = $apiResponse['status'] ? $apiResponse['data'] : [];

        if ($request->ajax()) {
            return response()->json(['roles' => $roles]);
        }

        return view('backend.settings.roles', ['roles' => $roles]);
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

        return $this->handleApiRequest($endpoint, $method, $body);
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

        return $this->handleApiRequest($endpoint, $method, $body);
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

        try {
            $apiStartPoint = env('API_START_POINT');
            $apiURL = $apiStartPoint.'/settings/roles/delete';
            $body = [
                'role_id' => $request->input('role_id'),
            ];

            $customRequest = Request::create($apiURL, 'POST', $body);
            $customRequest->headers->set('Accept', 'application/json');

            $response = app()->handle($customRequest);
            $data = json_decode($response->getContent(), true);

            if ($response->getStatusCode() === 201) {
                return response()->json([
                    'success' => true,
                    'message' => $data['message'] ?? 'Operetion Performed',
                ], 201);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => $data['message'] ?? 'Failed to perform transanction',
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
    
    public function fetchRole(Request $request){

        $endpoint = '/settings/roles/fetch';
        $apiResponse = $this->getViewDataFromApi($endpoint);

        $roles = $apiResponse['status'] ? $apiResponse['data'] : [];

        if ($request->ajax()) {
            return response()->json(['roles' => $roles]);
        }
    }

    // Regions
    public function showRegion()
    {
        // Code to handle showing regions
    }

    public function addRegion(Request $request)
    {
        // Code to handle adding a region
    }

    public function modifyRegion(Request $request)
    {
        // Code to handle modifying a region
    }

    public function removeRegion(Request $request)
    {
        // Code to handle removing a region
    }

    public function getRegion(Request $request)
    {
        // Code to handle getting a region
    }

    // Districts
    public function showDistrict()
    {
        // Code to handle showing districts
    }

    public function addDistrict(Request $request)
    {
        // Code to handle adding a district
    }

    public function modifyDistrict(Request $request)
    {
        // Code to handle modifying a district
    }

    public function removeDistrict(Request $request)
    {
        // Code to handle removing a district
    }

    public function getDistrict(Request $request)
    {
        // Code to handle getting a district
    }

    // Towns
    public function showTown()
    {
        // Code to handle showing towns
    }

    public function addTown(Request $request)
    {
        // Code to handle adding a town
    }

    public function modifyTown(Request $request)
    {
        // Code to handle modifying a town
    }

    public function removeTown(Request $request)
    {
        // Code to handle removing a town
    }

    public function getTown(Request $request)
    {
        // Code to handle getting a town
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
    public function showIdentityType()
    {
        // Code to handle showing identity types
    }

    public function addIdentityType(Request $request)
    {
        // Code to handle adding an identity type
    }

    public function modifyIdentityType(Request $request)
    {
        // Code to handle modifying an identity type
    }

    public function removeIdentityType(Request $request)
    {
        // Code to handle removing an identity type
    }

    public function getIdentityType(Request $request)
    {
        // Code to handle getting an identity type
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
