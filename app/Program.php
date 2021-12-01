<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name', 'code',
    ];

    public function information() {
        return $this->hasMany(Information::class);
    }
}
