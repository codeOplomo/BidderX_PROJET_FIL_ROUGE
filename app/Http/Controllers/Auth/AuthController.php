<?php

namespace App\Http\Controllers\Auth;

use App\Events\UserPresenceChanged;
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
use Illuminate\Validation\ValidationException;
use Illuminate\Http\RedirectResponse;


class AuthController extends Controller
{
    /**
     * Register a new user.
     */

    public function showRegister()
    {
        return view('auth.RegisterForm');
    }

    public function register(RegisterRequest $request): RedirectResponse
    {
        //dd($request->all());
        DB::beginTransaction();
        try {
            $user = User::create([
                'firstname' => $request->input('firstname'),
                'lastname' => $request->input('lastname'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
            ]);
//dd($user);
            $bidderRole = Role::where('id', 2)->firstOrFail();

            $user->roles()->attach($bidderRole);

            DB::commit();

            return redirect()->route('login')->with('success', 'Account successfully created. Please log in.');

        } catch (\Exception $exception) {
            DB::rollback();

            return redirect()->back()->withInput()->withErrors(['error' => 'Registration failed. Please try again.']);
        }
    }

    /**
     * Log in a user.
     */

    public function showLogin()
    {
        return view('auth.LoginForm');
    }

    public function login(LoginRequest $request)
{
    $credentials = $request->validated();

    $remember = $request->has('remember');

    if (Auth::attempt($credentials, $remember)) {
        $request->session()->regenerate();

        $user = Auth::user();
        $user->update(['is_active' => true]);

        //event(new UserPresenceChanged($user->id, true));

        if ($user->roles->contains('id', 1)) {
            return redirect()->route('admin.dashboard');
        } elseif($user->roles->contains('id', 2)) {
            return redirect()->route('profile.index');
        } elseif ($user->roles->contains('id', 3)) {
            return redirect()->route('profile.index');
        }

        return redirect()->route('home');
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ]);
}






    public function logout(Request $request)
    {
        $user = Auth::user();
        $user->update(['is_active' => false]);

        //event(new UserPresenceChanged($user->id, false));

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }





    /**
     * Get the authenticated User.
     */
    public function userProfile()
    {
        return response()->json(Auth::user());
    }
}
