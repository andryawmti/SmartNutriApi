<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public function admin()
    {
        return $this->belongsTo('App\Admin');
    }
}
