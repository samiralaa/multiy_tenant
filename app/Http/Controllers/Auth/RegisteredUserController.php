<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Store;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
   
     public function index()
     {
        return response()->json(User::all());
     }
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
    
        DB::beginTransaction();
        try {
            // Create the store
            $store = Store::create([
                'name' => $request->name,
                'domain' => Str::slug($request->name),
            ]);
    
            // Create the user associated with the store
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'store_id' => $store->id, // Assuming you have a store_id in users table
            ]);
    
            DB::commit();
    
            // Dispatch an event after successful creation
            event(new \App\Events\StoreCreated($store));
    
            // Log in the newly created user
            Auth::login($user);
    
            // Redirect to the dashboard route
            return redirect()->route('dashboard', [], false); // absolute: false for relative URL
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}
