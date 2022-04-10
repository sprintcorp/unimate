<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = [];
    protected $hidden =['deleted_at','updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function university()
    {
        return $this->belongsTo(University::class,'university_id');
    }

    public function faculty()
    {
        return $this->belongsTo(Faculty::class,'faculty_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class,'department_id');
    }
}
