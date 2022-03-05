<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseMaterial extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function courseOutline()
    {
        return $this->belongsTo(CourseOutline::class,'course_outline_id');
    }
}
