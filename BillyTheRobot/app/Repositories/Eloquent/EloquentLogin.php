<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Contracts\LoginRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class EloquentLogin implements LoginRepository
{

    function login()
    {
        return view('login');
    }

    function registration()
    {
        return view('registration');
    }

    function loginPost(Request|\App\Repositories\Contracts\Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('name', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended(route('dashboard'));
        }
        return redirect(route('login'))->with("error", "Invalid credentials");
    }

    function registrationPost(Request|\App\Repositories\Contracts\Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);

        $route = new User();
        $route->name = $request->name;
        $route->type = "";
        $route->status = "";
        $route->location = "";
        $route->tour_id = null;
        $route->password = Hash::make($request->password);
        $route->api_token = "";
        $user = $route->save();

        if (!$user) {
            return redirect(route('registration'))->with("error", "Registration failed");
        }
        return redirect(route('login'))->with("success", "Registration successful");
    }

    function logout()
    {
        Auth::logout();
        return redirect(route('login'));
    }
}


