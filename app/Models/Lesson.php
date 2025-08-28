<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class lesson extends Model
{
    protected $guarded = [];

    public $timestamps = false;


    public function course(){
        return $this->belongsTo(Course::class);
    }


    public function quiz(){
        return $this->hasOne(Quizz::class);
    }
}
