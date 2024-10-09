<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Image;
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
   
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'], // Validate image if provided
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
                'store_id' => $store->id, // Assuming you have a store_id in the users table
            ]);
    
            // Check if an image file is present in the request
            if ($request->hasFile('image')) {
              
                $imagePath = $request->file('image')->store('images');
                $image = new Image();
                $image->url = $imagePath;
                $image->store_id = $store->id; // Assuming you have a store_id in the images table
                $image->save();
            }
    
            DB::commit();
    
            // Dispatch an event after successful creation
            event(new \App\Events\StoreCreated($store));
    
            // // Log in the newly created user if in web 
            // Auth::login($user);
    
            // Return a JSON response with the user and store data
            return response()->json(['user' => $user, 'store' => $store], 201);
    
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
}
