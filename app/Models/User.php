<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'role_id',
        'otp',
        'remember_token',
        'email_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'password_token',
        'toke_set_time',
        'otp',
        'email_verified_at',
        'updated_at',
        'deleted_at',
        'role_id',
        'email_token',
        'pivot'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier() {
        return $this->getKey();
    }
    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims() {
        return [];
    }

    public function student()
    {
        return $this->hasOne(Student::class);
    }

    public function admin()
    {
        return $this->hasOne(Admin::class);
    }

    public function group()
    {
        return $this->hasMany(Group::class);
    }

    public function chat_sender()
    {
        return $this->hasMany(Chat::class,'user_id','id');
    }

    public function chat_receiver()
    {
        return $this->hasMany(Chat::class,'receiver_id','id');
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class,'course_users','user_id','course_id');
    }

    public function current_courses()
    {
        return $this->belongsToMany(Course::class,'course_users','user_id','course_id')
            ->wherePivot('status',1);
    }

    public function past_courses()
    {
        return $this->belongsToMany(Course::class,'course_users','user_id','course_id')
            ->wherePivot('status',0);
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class,'group_users','user_id','group_id');
    }

    public function reminders()
    {
        return $this->hasMany(Reminder::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function notes()
    {
        return $this->hasMany(NoteTaker::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class,'role_id');
    }
}
