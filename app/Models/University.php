<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class University extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = [];

    protected static function booted()
    {
        if(!request()->has('file')) {
            static::creating(function ($model) {
                $model->slug = Str::slug(request()->name);
            });
        }
    }

    public function faculties()
    {
        return $this->hasMany(Faculty::class);
    }

    public function chat()
    {
        return $this->hasMany(Chat::class);
    }
}
