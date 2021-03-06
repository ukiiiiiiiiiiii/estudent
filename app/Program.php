<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
    ];

    public function information() {
        return $this->hasMany(Information::class);
    }

    public function subjects() {
        return $this->hasMany(Subject::class);
    }

    public function users() {
        return $this->hasMany(User::class);
    }
}
