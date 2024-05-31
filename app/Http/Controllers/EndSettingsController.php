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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;


class EndSettingsController extends Controller
{

    // Bulk Remove
    public function bulkRemove(Request $request)
    {
        try {
            // Retrieve the values from the request
            $ids = $request->input('id');
            $table = $request->input('table');

            // Perform the bulk update
            $updated = DB::table($table)->whereIn('id', $ids)->update(['is_deleted' => 'Yes']);

            if ($updated) {
                return response()->json([
                    'status' => true,
                    'message' => 'Operation performed, records deleted successfully',
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Records not found or already deleted',
                ], 404);
            }
        } catch (ValidationException $e) {
            Log::error('Validation failed', ['errors' => json_encode($e->errors())]);
            return response()->json([
                'success' => false,
                'message' => 'Validation failed: ' . json_encode($e->errors()),
            ], 422);
        } catch (\Exception $e) {
            Log::error('Validation failed', ['errors' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'An error occurred: ' . $e->getMessage(),
            ], 500);
        }
    }

    // Roles
    public function viewRole()
    {
        try {
            $data = Role::where('is_deleted', '!=', 'Yes')->orderby('id', 'DESC')->get();
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
                'title' => 'required|string|max:30',
                'description' => 'required|string|max:1000',
            ]);

            // Check if a role with the same title already exists
            if (Role::where('title', $data['title'])->exists() && Role::where('title', $data['title'])->where('is_deleted', 'NO')->exists()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Record already exists in the database, try a different one.'
                ], 422);
            }
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
                'role_id' => 'required|integer|exists:roles,id',
                'title' => 'required|string|max:30',
                'description' => 'required|string|max:1000',
                'status' => 'required|string|max:10',
            ]);
            $idata = Role::find($data['role_id']);
            if ($idata) {
                $idata->update($data);
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

    public function destroyRole(Request $request)
    {
        try {
            $data = $request->validate([
                'role_id' => 'required|integer|exists:roles,id',
            ]);
            $idata = Role::find($data['role_id']);
            if ($idata) {

                $idata->is_deleted = 'Yes';
                $idata->save();
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

    public function fetchRole()
    {
        try {
            $data = Role::where('is_deleted', '!=', 'Yes')->orderBy('title', 'ASC')->orderBy('id', 'ASC')->get(['id', 'title']);
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


    // Regions
    public function viewRegion()
    {
        try {
            $data = Region::where('is_deleted', '!=', 'Yes')->orderby('id', 'DESC')->get();
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

    public function createRegion(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required|string',
            ]);

            // Check if a role with the same title already exists
            if (Region::where('name', $data['name'])->exists() && Region::where('name', $data['name'])->where('is_deleted', 'NO')->exists()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Record already exists in the database, try a different one.'
                ], 422);
            }
            $dbRequest = Region::create($data);
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

    public function updateRegion(Request $request)
    {
        try {
            $data = $request->validate([
                'region_id' => 'required|integer|exists:regions,id',
                'name' => 'required|string',
                'status' => 'required|string|max:10',
            ]);
            $region = Region::find($data['region_id']);
            if ($region) {
                $region->update($data);
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

    public function destroyRegion(Request $request)
    {
        try {
            $data = $request->validate([
                'region_id' => 'required|integer|exists:regions,id',
            ]);
            $idata = Region::find($data['region_id']);
            if ($idata) {

                $idata->is_deleted = 'Yes';
                $idata->save();
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

    public function getRegion(Request $request)
    {
        try {
            $data = Region::where('is_deleted', '!=', 'Yes')->orderBy('name', 'ASC')->orderBy('id', 'ASC')->get(['id', 'name']);
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

    // Districts
    public function viewDistrict(Request $request)
    {
        try {
            // Perform the join and retrieve the necessary fields
            $data = DB::table('districts as d')
            ->join('regions as r', 'd.region_id', '=', 'r.id')
            ->where('d.is_deleted', '!=', 'Yes')
            ->select('d.*', 'r.name as region')
            ->orderBy('d.id', 'DESC')
            ->get();
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

    public function createDistrict(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required|string',
                'region_id' => 'required|integer|exists:regions,id',
            ]);

            // Check if a role with the same title already exists
            if (District::where('name', $data['name'])->exists() && District::where('name', $data['name'])->where('is_deleted', 'NO')->exists()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Record already exists in the database, try a different one.'
                ], 422);
            }
            $dbRequest = District::create($data);
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

    public function updateDistrict(Request $request)
    {
        try {
            $data = $request->validate([
                'region_id' => 'required|integer|exists:regions,id',
                'district_id' => 'required|integer|exists:districts,id',
                'name' => 'required|string',
                'status' => 'required|string|max:10',
            ]);
            $idata = District::find($data['district_id']);
            if ($idata) {
                $idata->update($data);
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

    public function destroyDistrict(Request $request)
    {
        try {
            $data = $request->validate([
                'district_id' => 'required|integer|exists:districts,id',
            ]);
            $idata = District::find($data['district_id']);
            if ($idata) {

                $idata->is_deleted = 'Yes';
                $idata->save();
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

    public function getDistrict(Request $request)
    {
        try {
            $data = District::where('is_deleted', '!=', 'Yes')->orderBy('name', 'ASC')->orderBy('id', 'ASC')->get(['id', 'name']);
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

    public function getDistrictByRegion(Request $request)
    {
        $region_id = $request->input('region_id');
        try {
            $data = District::where('region_id', $region_id)
            ->where('is_deleted', '!=', 'Yes')->orderBy('name', 'ASC')
            ->orderBy('id', 'ASC')->get(['id', 'name']);
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

    // Towns
    public function viewTown()
    {
        try {
            $data = DB::table('towns as d')
            ->join('districts as r', 'd.district_id', '=', 'r.id')
            ->where('d.is_deleted', '!=', 'Yes')
            ->select('d.*', 'r.name as district')
            ->orderBy('d.id', 'DESC')
            ->get();
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

    public function createTown(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required|string',
                'district_id' => 'required|integer|exists:districts,id',
            ]);

            // Check if a role with the same title already exists
            if (Town::where('name', $data['name'])->exists() && Town::where('name', $data['name'])->where('is_deleted', 'NO')->exists()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Record already exists in the database, try a different one.'
                ], 422);
            }
            $dbRequest = Town::create($data);
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

    public function updateTown(Request $request)
    {
        try {
            $data = $request->validate([
                'town_id' => 'required|integer|exists:towns,id',
                'district_id' => 'required|integer|exists:districts,id',
                'name' => 'required|string',
                'status' => 'required|string|max:10',
            ]);
            $idata = Town::find($data['town_id']);
            if ($idata) {
                $idata->update($data);
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

    public function destroyTown(Request $request)
    {
        try {
            $data = $request->validate([
                'town_id' => 'required|integer|exists:towns,id',
            ]);
            $idata = Town::find($data['town_id']);
            if ($idata) {

                $idata->is_deleted = 'Yes';
                $idata->save();
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

    public function getTown(Request $request)
    {
        try {
            $data = Town::where('is_deleted', '!=', 'Yes')->orderBy('name', 'ASC')->orderBy('id', 'ASC')->get(['id', 'name']);
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

    public function getTownByDistrict(Request $request)
    {
        $district_id = $request->input('district_id');
        try {
            $data = Town::where('district_id', $district_id)
            ->where('is_deleted', '!=', 'Yes')->orderBy('name', 'ASC')
            ->orderBy('id', 'ASC')->get(['id', 'name']);
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
        try {
            $data = IdentityType::where('is_deleted', '!=', 'Yes')->orderby('id', 'DESC')->get();
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

    public function createIdentityType(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required|string',
            ]);

            // Check if a role with the same title already exists
            if (IdentityType::where('name', $data['name'])->exists() && IdentityType::where('name', $data['name'])->where('is_deleted', 'NO')->exists()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Record already exists in the database, try a different one.'
                ], 422);
            }
            $dbRequest = IdentityType::create($data);
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

    public function updateIdentityType(Request $request)
    {
        try {
            $data = $request->validate([
                'identitytype_id' => 'required|integer|exists:identity_types,id',
                'name' => 'required|string',
                'status' => 'required|string|max:10',
            ]);
            $idata = IdentityType::find($data['identitytype_id']);
            if ($idata) {
                $idata->update($data);
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

    public function destroyIdentityType(Request $request)
    {
        try {
            $data = $request->validate([
                'identitytype_id' => 'required|integer|exists:identity_types,id',
            ]);
            $idata = IdentityType::find($data['identitytype_id']);
            if ($idata) {

                $idata->is_deleted = 'Yes';
                $idata->save();
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

    public function getIdentityType(Request $request)
    {
        try {
            $data = IdentityType::where('is_deleted', '!=', 'Yes')->orderBy('name', 'ASC')->orderBy('id', 'ASC')->get(['id', 'name']);
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



