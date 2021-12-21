<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'exam_id', 'subject_id', 'user_id', 'result'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function exam() {
        return $this->belongsTo(Exam::class);
    }

    public function subject() {
        return $this->belongsTo(Subject::class);
    }
}
