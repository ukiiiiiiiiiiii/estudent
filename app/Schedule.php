<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'subject_id', 'type', 'start', 'end',
    ];

    public function subject() {
        return $this->belongsTo(Subject::class);
    }
}
