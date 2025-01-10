<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{
    use HasFactory;
    //
    public $protected = ['question_id','choice'];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

}
