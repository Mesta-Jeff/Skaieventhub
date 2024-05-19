<?php

namespace App\Http\Controllers\api;

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

class SettingsController extends Controller
{
    // Regions
    public function viewRegion()
    {
        $regions = Region::all();
        return response()->json($regions);
    }

    public function createRegion(Request $request)
    {
        $region = Region::create($request->only('name'));
        return response()->json($region, 201);
    }

    public function updateRegion(Request $request)
    {
        $region = Region::find($request->id);
        if ($region) {
            $region->update($request->only('name'));
            return response()->json($region);
        }
        return response()->json(['error' => 'Region not found'], 404);
    }

    public function destroyRegion(Request $request)
    {
        $region = Region::find($request->id);
        if ($region) {
            $region->delete();
            return response()->json(['message' => 'Region deleted']);
        }
        return response()->json(['error' => 'Region not found'], 404);
    }

    public function sortRegion()
    {
        $regions = Region::orderBy('name')->get();
        return response()->json($regions);
    }

    // Districts
    public function viewDistrict()
    {
        $districts = District::all();
        return response()->json($districts);
    }

    public function createDistrict(Request $request)
    {
        $district = District::create($request->only('name', 'region_id'));
        return response()->json($district, 201);
    }

    public function updateDistrict(Request $request)
    {
        $district = District::find($request->id);
        if ($district) {
            $district->update($request->only('name', 'region_id'));
            return response()->json($district);
        }
        return response()->json(['error' => 'District not found'], 404);
    }

    public function destroyDistrict(Request $request)
    {
        $district = District::find($request->id);
        if ($district) {
            $district->delete();
            return response()->json(['message' => 'District deleted']);
        }
        return response()->json(['error' => 'District not found'], 404);
    }

    public function sortDistrict()
    {
        $districts = District::orderBy('name')->get();
        return response()->json($districts);
    }

    // Towns
    public function viewTown()
    {
        $towns = Town::all();
        return response()->json($towns);
    }

    public function createTown(Request $request)
    {
        $town = Town::create($request->only('name', 'district_id'));
        return response()->json($town, 201);
    }

    public function updateTown(Request $request)
    {
        $town = Town::find($request->id);
        if ($town) {
            $town->update($request->only('name', 'district_id'));
            return response()->json($town);
        }
        return response()->json(['error' => 'Town not found'], 404);
    }

    public function destroyTown(Request $request)
    {
        $town = Town::find($request->id);
        if ($town) {
            $town->delete();
            return response()->json(['message' => 'Town deleted']);
        }
        return response()->json(['error' => 'Town not found'], 404);
    }

    public function sortTown()
    {
        $towns = Town::orderBy('name')->get();
        return response()->json($towns);
    }

    // Roles
    public function viewRole()
    {
        $roles = Role::all();
        return response()->json($roles);
    }

    public function createRole(Request $request)
    {
        $role = Role::create($request->only('name'));
        return response()->json($role, 201);
    }

    public function updateRole(Request $request)
    {
        $role = Role::find($request->id);
        if ($role) {
            $role->update($request->only('name'));
            return response()->json($role);
        }
        return response()->json(['error' => 'Role not found'], 404);
    }

    public function destroyRole(Request $request)
    {
        $role = Role::find($request->id);
        if ($role) {
            $role->delete();
            return response()->json(['message' => 'Role deleted']);
        }
        return response()->json(['error' => 'Role not found'], 404);
    }

    public function sortRole()
    {
        $roles = Role::orderBy('name')->get();
        return response()->json($roles);
    }

    // Permissions
    public function viewPermission()
    {
        $permissions = Permission::all();
        return response()->json($permissions);
    }

    public function createPermission(Request $request)
    {
        $permission = Permission::create($request->only('name'));
        return response()->json($permission, 201);
    }

    public function updatePermission(Request $request)
    {
        $permission = Permission::find($request->id);
        if ($permission) {
            $permission->update($request->only('name'));
            return response()->json($permission);
        }
        return response()->json(['error' => 'Permission not found'], 404);
    }

    public function destroyPermission(Request $request)
    {
        $permission = Permission::find($request->id);
        if ($permission) {
            $permission->delete();
            return response()->json(['message' => 'Permission deleted']);
        }
        return response()->json(['error' => 'Permission not found'], 404);
    }

    public function sortPermission()
    {
        $permissions = Permission::orderBy('name')->get();
        return response()->json($permissions);
    }

    // User Permissions
    public function viewUserPermission()
    {
        $userPermissions = UserPermission::all();
        return response()->json($userPermissions);
    }

    public function createUserPermission(Request $request)
    {
        $userPermission = UserPermission::create($request->only('user_id', 'permission_id'));
        return response()->json($userPermission, 201);
    }

    public function updateUserPermission(Request $request)
    {
        $userPermission = UserPermission::find($request->id);
        if ($userPermission) {
            $userPermission->update($request->only('user_id', 'permission_id'));
            return response()->json($userPermission);
        }
        return response()->json(['error' => 'User Permission not found'], 404);
    }

    public function destroyUserPermission(Request $request)
    {
        $userPermission = UserPermission::find($request->id);
        if ($userPermission) {
            $userPermission->delete();
            return response()->json(['message' => 'User Permission deleted']);
        }
        return response()->json(['error' => 'User Permission not found'], 404);
    }

    public function sortUserPermission()
    {
        $userPermissions = UserPermission::orderBy('user_id')->get();
        return response()->json($userPermissions);
    }

    // Identity Types
    public function viewIdentityType()
    {
        $identityTypes = IdentityType::all();
        return response()->json($identityTypes);
    }

    public function createIdentityType(Request $request)
    {
        $identityType = IdentityType::create($request->only('name'));
        return response()->json($identityType, 201);
    }

    public function updateIdentityType(Request $request)
    {
        $identityType = IdentityType::find($request->id);
        if ($identityType) {
            $identityType->update($request->only('name'));
            return response()->json($identityType);
        }
        return response()->json(['error' => 'Identity Type not found'], 404);
    }

    public function destroyIdentityType(Request $request)
    {
        $identityType = IdentityType::find($request->id);
        if ($identityType) {
            $identityType->delete();
            return response()->json(['message' => 'Identity Type deleted']);
        }
        return response()->json(['error' => 'Identity Type not found'], 404);
    }

    public function sortIdentityType()
    {
        $identityTypes = IdentityType::orderBy('name')->get();
        return response()->json($identityTypes);
    }

    // Notifications
    public function viewNotification()
    {
        $notifications = Notification::all();
        return response()->json($notifications);
    }

    public function createNotification(Request $request)
    {
        $notification = Notification::create($request->only(['user_id', 'message', 'status']));
        return response()->json($notification, 201);
    }

    public function updateNotification(Request $request)
    {
        $notification = Notification::find($request->id);
        if ($notification) {
            $notification->update($request->only(['user_id', 'message', 'status']));
            return response()->json($notification);
        }
        return response()->json(['error' => 'Notification not found'], 404);
    }

    public function destroyNotification(Request $request)
    {
        $notification = Notification::find($request->id);
        if ($notification) {
            $notification->delete();
            return response()->json(['message' => 'Notification deleted']);
        }
        return response()->json(['error' => 'Notification not found'], 404);
    }

    public function sortNotification()
    {
        $notifications = Notification::orderBy('created_at')->get();
        return response()->json($notifications);
    }

    // API Routes
    public function viewAPIRoute()
    {
        $apiRoutes = APIRoute::all();
        return response()->json($apiRoutes);
    }

    public function createAPIRoute(Request $request)
    {
        $apiRoute = ApiRoute::create($request->only(['route', 'description']));
        return response()->json($apiRoute, 201);
    }

    public function updateAPIRoute(Request $request)
    {
        $apiRoute = ApiRoute::find($request->id);
        if ($apiRoute) {
            $apiRoute->update($request->only(['route', 'description']));
            return response()->json($apiRoute);
        }
        return response()->json(['error' => 'API Route not found'], 404);
    }

    public function destroyAPIRoute(Request $request)
    {
        $apiRoute = ApiRoute::find($request->id);
        if ($apiRoute) {
            $apiRoute->delete();
            return response()->json(['message' => 'API Route deleted']);
        }
        return response()->json(['error' => 'API Route not found'], 404);
    }

    public function sortAPIRoute()
    {
        $apiRoutes = ApiRoute::orderBy('route')->get();
        return response()->json($apiRoutes);
    }

}

