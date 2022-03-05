<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Department extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    protected static function booted()
    {
        static::creating(function ($model) {
            $model->slug = Str::slug(request()->name).'-'.request()->faculty_id;
        });
    }

    public function faculty()
    {
        return $this->belongsTo(Faculty::class,'faculty_id');
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function time_table()
    {
        return $this->hasMany(Timetable::class);
    }
}
