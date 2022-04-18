<?php

namespace App\Interfaces;

interface Auth
{
    public function register($data);
    public function login($data);
    public function otp($data);
    public function reset($data);
    public function passwordReset($data);
    public function updateProfile($data);
    public function accountSetup($data);
    public function userProfile();
    public function verify($data);
}
