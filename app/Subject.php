<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'program_id', 'subject_id', 'name', 'grade', 'espb',
    ];

    public function program() {
        return $this->belongsTo(Program::class);
    }

    public function schedule() {
        return $this->hasOne(Schedule::class);
    }

    public function exams() {
        return $this->hasMany(Exam::class);
    }

    public function results() {
        return $this->hasMany(Result::class);
    }
}
