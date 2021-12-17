<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    public $timestamps = false;

    protected $fillable = [

    ];

    public function subject() {
        return $this->belongsTo(Subject::class);
    }
}
