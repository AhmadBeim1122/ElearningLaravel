<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quizz extends Model
{
    protected $guarded = [];

    public $timestamps = false;

    protected $table = 'quizzes';


    public function lesson(){
        return $this->belongsTo(lesson::class);
    }
}
