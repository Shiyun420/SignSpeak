<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizTaken extends Model
{
    use HasFactory;

    protected $fillable = ['marks', 'studentid', 'quizid'];

    // Define the relationship with the Quiz model
    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'quizid', 'id');
    }
}
