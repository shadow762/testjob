<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = ['surname', 'name', 'lastname', 'bithday', 'sex_id', 'image'];

    public $timestamps = false;

    public function sex() {
        return $this->belongsTo(Sex::class, 'sex_id', 'id');
    }
}
