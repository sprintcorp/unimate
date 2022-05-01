<?php

namespace App\Http\Controllers\v1;

use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\RegistrationRequest;
use App\Interfaces\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class AuthController extends Controller
{
    public function __construct(protected Auth $auth){}

    public function register(RegistrationRequest $request)
    {
        return $this->auth->register($request->all());
    }

    public function accountSetup(RegistrationRequest $request)
    {

        return $this->auth->accountSetup($request->all());
    }

    public function login(LoginRequest $request)
    {
        return $this->auth->login($request->all());
    }

    public function otp(LoginRequest $request)
    {

    }

    public function reset(LoginRequest $request)
    {
        return $this->auth->reset($request->all());
    }

    public function passwordReset(LoginRequest $request)
    {
        return $this->auth->passwordReset($request->all());
    }

    public function updateProfile(RegistrationRequest $request)
    {
        return $this->auth->updateProfile($request->all());
    }

    public function userProfile()
    {
        return $this->auth->userProfile();
    }

    public function verify(Request $request)
    {
        return $this->auth->verify($request->token);
    }
}
