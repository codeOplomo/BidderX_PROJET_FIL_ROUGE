<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Address;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    /**
     * Register a new user.
     */

    public function register(RegisterRequest $request)
    {
        DB::beginTransaction(); // Start a transaction

        try {
            // Create the user
            $user = User::create([
                'firstname' => $request['firstname'],
                'lastname' => $request['lastname'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
            ]);

            // Create the address
            $address = new Address([
                'user_id' => $user->id,
                'country' => $request['country'],
                'city' => $request['city'],
                // Add more fields here as needed
            ]);
            $address->save();

            // Find the role by name (adjust the role name as needed)
            $role = Role::where('name', 'admin')->firstOrFail();
            // Attach the role to the user
            $user->roles()->attach($role);

            // If everything's fine, commit the transaction
            DB::commit();

            // Optionally create a token for the user
            //$token = $user->createToken('authToken')->plainTextToken;

            // Return the user and token information
            return response()->json(['user' => $user->load('roles')]);
        } catch (\Exception $e) {
            // If there's an error, rollback the transaction
            DB::rollback();
            return response()->json(['error' => 'Registration failed: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Log in a user.
     */
    public function login(LoginRequest $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Invalid login details'], 401);
        }

        $user = Auth::user();
        // Load the roles for the user
        $user->load('roles'); // Assuming your User model has a 'roles' relationship defined

        $token = $user->createToken('authToken')->plainTextToken;

        // Return user info along with roles and token
        return response()->json([
            'user' => $user,
            'token' => $token,
            // If you want to simplify the roles structure, adjust as needed
        ]);
    }



    public function logout(Request $request)
{
    // Revoke the token that was used to authenticate the current request...
    $request->user()->currentAccessToken()->delete();

    return response()->json(['message' => 'Successfully logged out']);
}

    /**
     * Get the authenticated User.
     */
    public function userProfile()
    {
        return response()->json(Auth::user());
    }
}
