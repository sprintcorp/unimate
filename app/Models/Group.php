<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function chat()
    {
        return $this->hasMany(Chat::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class,'group_users','group_id','user_id');
    }
}
