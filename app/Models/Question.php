<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //
    protected $fillable = ['survey_id', 'question', 'type'];

    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }

    public function choices()
    {
        return $this->hasMany(Choice::class);
    }
}
