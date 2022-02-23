<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faculty extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function university()
    {
        return $this->belongsTo(University::class,'university_id');
    }

    public function departments()
    {
        return $this->hasMany(Department::class);
    }
}
