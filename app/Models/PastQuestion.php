<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PastQuestion extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function course()
    {
        return $this->belongsTo(Course::class,'course_id');
    }

    public function answers()
    {
        return $this->hasMany(Answers::class);
    }
}
