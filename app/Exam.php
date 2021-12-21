<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'subject_id', 'date', 'time'
    ];

    public function subject() {
        return $this->belongsTo(Subject::class);
    }

    public function results() {
        return $this->hasMany(Result::class);
    }
}
