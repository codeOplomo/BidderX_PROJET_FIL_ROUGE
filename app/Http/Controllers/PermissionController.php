<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of permissions.
     */
    public function index()
    {
        $permissions = Permission::all();
        return response()->json($permissions);
    }

    /**
     * Store a newly created permission in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:permissions',
            'description' => 'sometimes|string',
        ]);

        $permission = Permission::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return response()->json([
            'message' => 'Permission created successfully!',
            'permission' => $permission
        ], 201);
    }

    /**
     * Display the specified permission.
     */
    public function show($id)
    {
        $permission = Permission::find($id);

        if (!$permission) {
            return response()->json(['message' => 'Permission not found'], 404);
        }

        return response()->json($permission);
    }

    /**
     * Update the specified permission in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|unique:permissions,name,' . $id,
            'description' => 'sometimes|string',
        ]);

        $permission = Permission::find($id);

        if (!$permission) {
            return response()->json(['message' => 'Permission not found'], 404);
        }

        $permission->update($request->all());

        return response()->json([
            'message' => 'Permission updated successfully!',
            'permission' => $permission
        ]);
    }

    /**
     * Remove the specified permission from storage.
     */
    public function destroy($id)
    {
        $permission = Permission::find($id);

        if (!$permission) {
            return response()->json(['message' => 'Permission not found'], 404);
        }

        $permission->delete();

        return response()->json(['message' => 'Permission deleted successfully']);
    }
}
