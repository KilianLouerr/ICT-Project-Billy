<?php

namespace App\Repositories\Contracts;

interface LoginRepository
{
    function login();
    function registration();
    function loginPost(Request $request);
    function registrationPost(Request $request);
    function logout();

}
