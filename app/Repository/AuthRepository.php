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
        $token_reg = rand(1000,9999);
        if(!array_key_exists('role_id',$data)){
            $data['role_id'] = 2;
        }
        try {
            DB::beginTransaction();
            $user = User::create([
                'email'=> $data['email'],
                'role_id'=> $data['role_id'],
                'password' => Hash::make($data['password']),
                'username' => $data['username'] ?? NULL,
                'email_token' => $token_reg
            ]);
            $role = $data['role_id'];
            $data['user_id'] = $user->id;

            $userData = $data;
            $userData['email_token'] = $token_reg;
            unset($data['email']);
            unset($data['password']);
            unset($data['username']);
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
            return $this->showModelWithMessage($user,'user registered successfully',201);

        } catch(\Exception $exp) {
            DB::rollBack();
            return $this->errorResponse($exp->getMessage(),400);
        }
    }

    public function accountSetup($data)
    {
        try {
            DB::beginTransaction();
            if(request()->has('username'))
            {
                auth()->user()->update([
                    'username'=>$data['username'] ?? NULL,
                ]);
            }
            if(array_key_exists('image',$data)){
                $image = $this->fileUpload($data['image']->getRealPath());
                $image_url = $image->getSecurePath();
                $image_id = $image->getPublicId();
            }
            auth()->user()->student->update([
                'university_id'=>$data['university_id'] ?? NULL,
                'faculty_id'=>$data['faculty_id'] ?? NULL,
                'department_id'=>$data['department_id'] ?? NULL,
                'level'=> $data['level'] ?? NULL,
                'semester'=>$data['semester'] ?? NULL,
                'gender'=>$data['gender'] ?? NULL,
                'birth_date'=>$data['birth_date'] ?? NULL,
                'image'=> $image_url ?? NULL,
                'image_id'=> $image_id ?? NULL,
            ]);
//            dd($data['level']);
            if(request()->has('course_id')) {
                auth()->user()->courses()->attach($data['course_id'],
                    [
                        'level' => $data['level'],
                        'semester' => $data['semester'],
                        'year' => date('Y'),
                        'created_at' => now(),
                    ]);
            }

            DB::commit();
            return $this->successResponse('account setup successful',200);

        } catch(\Exception $exp) {
            DB::rollBack();
            return $this->errorResponse($exp->getMessage(),400);
        }
    }

    public function login($data)
    {
        $username = $data['username'];

        if(filter_var($username, FILTER_VALIDATE_EMAIL)) {
            $token = auth()->attempt(['email' => $username, 'password' => $data['password']]);
        } else {
            $token = auth()->attempt(['username' => $username, 'password' => $data['password']]);
        }

        if (!$token) {
            return $this->errorResponse('invalid login credentials', 404);
        }

        if(auth()->user()->email_verified_at){
            return $this->createNewToken($token);
        }

        $token = rand(1000,9999);
        $data['email_token'] = $token;
        $data['email'] = auth()->user()->email;
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
//        $token = Hash::make(now().$data['email']);
        $token = rand(1000,9999);
        $user->update(['remember_token'=> $token]);
        Mail::to($user->email)->send(new PasswordResetMail($user));
        return $this->showMessage('Password reset token has been sent to your mail');
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
        auth()->user()->email = $data['email'] ?? NULL;
        auth()->user()->username = $data['username'] ?? NULL;
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

            auth()->user()->admin->update([
                'firstname'=>$data['firstname'] ?? NULL,
                'lastname'=>$data['lastname'] ?? NULL,
                'other_name'=>$data['other_name'] ?? NULL,
                'phone'=>$data['phone'] ?? NULL,
                'gender'=>$data['gender'] ?? NULL,
                'birth_date'=>$data['birth_date'] ?? NULL,
                'image'=>$data['image'] ?? NULL,
                'image_id'=>$data['image_id'] ?? NULL,
            ]);
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

    public function verify($data)
    {

        $user = User::where('email_token',$data)->first();
        if($user){
            $user->email_verified_at = now();
            $user->email_token = NULL;
            $user->save();
            return $this->successResponse('email verification successful',200);
        }
        return $this->errorResponse('Invalid token',400);
    }

}
