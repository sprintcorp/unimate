<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Faculty extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    protected static function booted()
    {
        if(!request()->has('file')) {
            static::creating(function ($model) {
                $model->slug = Str::slug(request()->name) . '-' . request()->university_id;
            });
        }
    }

    public function university()
    {
        return $this->belongsTo(University::class,'university_id');
    }

    public function departments()
    {
        return $this->hasMany(Department::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
