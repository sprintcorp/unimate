<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chat extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    protected $hidden = ['university_id','updated_at','deleted_at',
        'group_id','course_id','receiver_id'];

    protected static function booted()
    {
        static::creating(function ($model) {
            $model->user_id = auth()->user()->id;
            $model->university_id = auth()->user()->student->university_id ?? NULL;
        });
    }

    public function groups()
    {
        return $this->belongsTo(Chat::class,'group_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class,'course_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class,'receiver_id','id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function university()
    {
        return $this->belongsTo(University::class,'university_id');
    }
}
