<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Timetable extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = [];

    public function department()
    {
        return $this->belongsTo(Department::class,'department_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class,'course_id');
    }
}
