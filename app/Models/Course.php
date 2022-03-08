<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function department()
    {
        return $this->belongsTo(Department::class,'department_id');
    }

    public function courseOutline()
    {
        return $this->hasMany(CourseOutline::class);
    }

    public function pastQuestion()
    {
        return $this->hasMany(PastQuestion::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class,'course_users','course_id','user_id');
    }

    public function chat()
    {
        return $this->hasMany(Chat::class);
    }

    public function time_table()
    {
        return $this->hasMany(Timetable::class);
    }
}
