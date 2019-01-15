<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model{
    public function consultation()
    {
        $this->hasMany('App\Consultation');
    }
}
