<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizResult extends Model
{
    
    protected $guarded = [];

    public $timestamps = false;

    protected $table = 'quiz_results';
}
