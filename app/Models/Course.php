<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $guarded = [];

    public $timestamps = false;


    public function lesson(){
        return $this->hasMany(Lesson::class);
    }

    
    public function user(){
        return $this->belongsTo(User::class,'Ins_id');
    }
    
    public function enroll(){
        return $this->hasMany(Enroll::class, 'course_id');
    }


}


