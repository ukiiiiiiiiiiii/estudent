<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'program_id', 'name', 'grade', 'espb',
    ];

    public function program() {
        return $this->belongsTo(Program::class);
    }
}
