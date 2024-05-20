<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Town;
use App\Models\Region;
use App\Models\ApiRoute;
use App\Models\District;
use App\Models\Permission;
use App\Models\IdentityType;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\UserPermission;
use Illuminate\Validation\ValidationException;


class EndSettingsController extends Controller
{
    // Roles
    public function viewRole()
    {
        try {
            $data = Role::where('is_deleted', '!=', 'Yes')->get();
            return response()->json([
                'success' => true,
                'message' => 'Data retrieved successfully',
                'data' => $data
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function createRole(Request $request)
    {
        try {
            $data = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string|max:1000',
            ]);

            $dbRequest = Role::create($data);
            if ($dbRequest) {
                return response()->json([
                    'success'=> true,
                    'message'=> 'Request to perform database operation has gone through successful',
                ], 201);
            } else {
                return response()->json([
                    'success'=> false,
                    'message'=> 'Sorry request to the database has declined, try again later',
                ], 409);
            }
        } catch (ValidationException $e) {
            return response()->json([
                'success'=> false,
                'message' => 'Validation failed because: '. json_encode($e->errors()),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success'=> false,
                'message' => 'An error occurred: ' . json_encode($e->getMessage()),
            ], 500);
        }
    }

    public function updateRole(Request $request)
    {
        try {
            $data = $request->validate([

            ]);

            $dbRequest = Role::create($data);
            if ($dbRequest) {
                return response()->json([
                    'success'=> true,
                    'message'=> 'Request to perform database operation has gone through successful',
                ], 201);
            } else {
                return response()->json([
                    'success'=> false,
                    'message'=> 'Sorry request to the database has declined, try again later',
                ], 409);
            }
        } catch (ValidationException $e) {
            return response()->json([
                'success'=> false,
                'message' => 'Validation failed because: '. json_encode($e->errors()),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success'=> false,
                'message' => 'An error occurred: ' . json_encode($e->getMessage()),
            ], 500);
        }
    }

    public function destroyRole(Request $request)
    {
        try {
            $data = $request->validate([
                'role_id' => 'required|integer|exists:roles,id',
            ]);
            $role = Role::find($data['role_id']);
            if ($role) {

                $role->is_deleted = 'Yes';
                $role->save();
                return response()->json([
                    'success' => true,
                    'message' => 'Request to perform database operation has gone through successful',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Record you want to remove cannot found',
                ], 404);
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

    // Regions
    public function viewRegion()
    {
        // Code to handle viewing regions
    }

    public function createRegion(Request $request)
    {
        // Code to handle creating a region
    }

    public function updateRegion(Request $request)
    {
        // Code to handle updating a region
    }

    public function destroyRegion(Request $request)
    {
        // Code to handle deleting a region
    }

    public function getRegion(Request $request)
    {
        // Code to handle getting a region
    }

    // Districts
    public function viewDistrict()
    {
        // Code to handle viewing districts
    }

    public function createDistrict(Request $request)
    {
        // Code to handle creating a district
    }

    public function updateDistrict(Request $request)
    {
        // Code to handle updating a district
    }

    public function destroyDistrict(Request $request)
    {
        // Code to handle deleting a district
    }

    public function getDistrict(Request $request)
    {
        // Code to handle getting a district
    }

    // Towns
    public function viewTown()
    {
        // Code to handle viewing towns
    }

    public function createTown(Request $request)
    {
        // Code to handle creating a town
    }

    public function updateTown(Request $request)
    {
        // Code to handle updating a town
    }

    public function destroyTown(Request $request)
    {
        // Code to handle deleting a town
    }

    public function getTown(Request $request)
    {
        // Code to handle getting a town
    }

    // Permissions
    public function viewPermission()
    {
        // Code to handle viewing permissions
    }

    public function createPermission(Request $request)
    {
        // Code to handle creating a permission
    }

    public function updatePermission(Request $request)
    {
        // Code to handle updating a permission
    }

    public function destroyPermission(Request $request)
    {
        // Code to handle deleting a permission
    }

    public function getPermission(Request $request)
    {
        // Code to handle getting a permission
    }

    // User Permissions
    public function viewUserPermission()
    {
        // Code to handle viewing user permissions
    }

    public function createUserPermission(Request $request)
    {
        // Code to handle creating a user permission
    }

    public function updateUserPermission(Request $request)
    {
        // Code to handle updating a user permission
    }

    public function destroyUserPermission(Request $request)
    {
        // Code to handle deleting a user permission
    }

    public function getUserPermission(Request $request)
    {
        // Code to handle getting a user permission
    }

    // Identity Types
    public function viewIdentityType()
    {
        // Code to handle viewing identity types
    }

    public function createIdentityType(Request $request)
    {
        // Code to handle creating an identity type
    }

    public function updateIdentityType(Request $request)
    {
        // Code to handle updating an identity type
    }

    public function destroyIdentityType(Request $request)
    {
        // Code to handle deleting an identity type
    }

    public function getIdentityType(Request $request)
    {
        // Code to handle getting an identity type
    }

    // Notifications
    public function viewNotification()
    {
        // Code to handle viewing notifications
    }

    public function createNotification(Request $request)
    {
        // Code to handle creating a notification
    }

    public function updateNotification(Request $request)
    {
        // Code to handle updating a notification
    }

    public function destroyNotification(Request $request)
    {
        // Code to handle deleting a notification
    }

    public function getNotification(Request $request)
    {
        // Code to handle getting a notification
    }

    // API Routes
    public function viewAPIRoute()
    {
        // Code to handle viewing API routes
    }

    public function createAPIRoute(Request $request)
    {
        // Code to handle creating an API route
    }

    public function updateAPIRoute(Request $request)
    {
        // Code to handle updating an API route
    }

    public function destroyAPIRoute(Request $request)
    {
        // Code to handle deleting an API route
    }

    public function getAPIRoute(Request $request)
    {
        // Code to handle getting an API route
    }
}



