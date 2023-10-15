<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\LoginRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthManager extends Controller
{
    private $login;
    
    public function __construct(LoginRepository $login)
    {
        $this->login = $login;
    }

    function login() {
        return view('login');
    }

    function loginPost(Request $request) {
        return $this->login->loginPost($request);
    }

    function logout() {
        Auth::logout();
        return redirect()->route('login');
    }

    function registration() {
        return view('registration');
    }

    function registrationPost(Request $request) {
        return $this->login->registrationPost($request);
    }
}
