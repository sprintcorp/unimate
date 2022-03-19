<?php

namespace App\Repository;

use App\Http\Resources\User\AuthResources;
use App\Interfaces\Auth;
use App\Mail\EmailVerificationMail;
use App\Mail\PasswordResetMail;
use App\Models\Admin;
use App\Models\Student;
use App\Models\User;
use App\Traits\ApiResponser;
use App\Traits\FileManager;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthRepository implements Auth
{
    use ApiResponser,FileManager;

    public function register($data)
    {

        $token_reg = Hash::make($data['email'].now());
        try {
            DB::beginTransaction();
            $user = User::create([
                'email'=> $data['email'],
                'role_id'=> $data['role_id'],
                'password' => Hash::make($data['password']),
                'email_token' => $token_reg
            ]);
            $role = $data['role_id'];
            $data['user_id'] = $user->id;
            $userData = $data;
            $userData['email_token'] = $token_reg;
            unset($data['email']);
            unset($data['password']);
            unset($data['role_id']);
            if(array_key_exists('image',$data)){
                $image = $this->fileUpload($data['image']->getRealPath());
                $data['image'] = $image->getSecurePath();
                $data['image_id'] = $image->getPublicId();
            }
            if($role == 1){
                Admin::create($data);
            }else{
                Student::create($data);
            }
            Mail::to($userData['email'])->send(new EmailVerificationMail($userData));
            DB::commit();

            return $this->showOne($user,201);

        } catch(\Exception $exp) {
            DB::rollBack();
            return $this->errorResponse($exp->getMessage(),400);
        }
    }

    public function login($data)
    {
        if (!$token = auth()->attempt($data)) {
            return $this->errorResponse('invalid login credentials', 404);
        }

        if(auth()->user()->email_verified_at){
            return $this->createNewToken($token);
        }

        $token = Hash::make($data['email'].now());
        $data['email_token'] = $token;
        auth()->user()->email_token = $token;
        auth()->user()->save();
        Mail::to($data['email'])->send(new EmailVerificationMail($data));
        return $this->errorResponse('Email not verified yet, pls check your mail for email verification mail',400);
    }

    public function otp($data)
    {

    }

    public function reset($data)
    {
        $user = User::where('email',$data['email'])->first();
        $token = Hash::make(now().$data['email']);
        $user->update(['remember_token'=> $token]);
        Mail::to($user->email)->send(new PasswordResetMail($user));
        return $this->showMessage('Password reset link sent');
    }

    public function passwordReset($data)
    {
        $user = User::where('remember_token',$data['token'])->first();
        if($user){
            $time = Carbon::parse($user->updated_at);
            $now = Carbon::parse(now());
            $totalDuration = $now->diffInMinutes($time);
            if($totalDuration < 60){
                $user->password = bcrypt($data['password']);
                $user->remember_token = NULL;
                $user->save();
                return $this->showMessage('Password reset successfully',200);
            }else{
                return $this->errorResponse('Password token expired',400);
            }
        }else{
            return $this->showMessage('Invalid token',404);
        }
    }

    public function updateProfile($data)
    {
        if(array_key_exists('password',$data)) {
            if (Hash::check($data['old_password'], $data['password'])) {
                auth()->user()->password = bcrypt($data['password']);
            }else{
                return $this->errorResponse('Password is incorrect', 404);
            }
        }
        auth()->user()->email = $data['email'];
        auth()->user()->save();
        unset($data['email']);
        unset($data['password']);
        if(array_key_exists('image',$data)){
            $image = $this->fileUpload($data['image']->getRealPath());
            $data['image'] = $image->getSecurePath();
            $data['image_id'] = $image->getPublicId();
        }
        if(\auth()->user()->role_id == 1)
        {
            auth()->user()->admin->update($data);
        }else{
            auth()->user()->student->update($data);
        }
        return $this->successResponse(auth()->user(),200);
    }

    public function userProfile()
    {
        return $this->successResponse(new AuthResources(auth()->user()),200);
    }

    public function createNewToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => new AuthResources(auth()->user()),
        ]);
    }

    public function verify()
    {
        $token = request()->get('token');
        $user = User::where('email_token',$token)->first();
        if($user){
            $user->email_verified_at = now();
            $user->save();
            return redirect('verify-success');
        }
        return $this->errorResponse('Invalid token',400);
    }
}
