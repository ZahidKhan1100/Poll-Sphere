<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    use HasFactory;
    //
    public $fillable = ['survey_id', 'question_id'];

    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function choices()
    {
        return $this->belongsToMany(Choice::class, 'response_choice');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
