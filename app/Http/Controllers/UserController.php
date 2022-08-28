<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // Show Register/Create Form
    public function create() {
        return view('users.register');
    }

    //Create New User
    public function store(Request $request) {
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],//This means that the name will have to be atleast 3 characters.
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            // This ensures that email entries in database are unique to the users table and also to the 
            // email field. the first value is the table 'users' and then the second value 'email' 
            //tells it that the email field under the 'users' table should be unique.
            // 'password' => ['required, confirmed, min:6']
            'password' => 'required|confirmed|min:6'
            //This means that all three validation logic will be applied.
            //The confirmed means that this field will be checked by laravel to match the password_confirmation
            //field. It automatically requires the password and password_confirmation fields to be same if you 
            //use this logic.
        ]);

        //Hash Password
        $formFields['password'] = bcrypt($formFields['password']);

        // Create User
        $user = User::create($formFields);

        // Login
        auth()->login($user);
        //We use the auth() to authorize the newly created users login
        return redirect('/')->with('message', 'User created and logged in');
    }

    // Logout User
    public function logout(Request $request) {
        auth()->logout();
        //Removes authentication from the users session
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        //This is a recommended extra security measure required when logging user out.
        return redirect('/')->with('message', 'You have been logged out!');
    }
}
