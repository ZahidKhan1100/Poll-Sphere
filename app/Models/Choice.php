<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{
    //
    public $protected = ['question_id','choice'];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

}
