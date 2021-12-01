<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    protected $fillable = [
        'program_id', 'grade', 'text',
    ];

    public function program() {
        return $this->belongsTo(Program::class);
    }
}
