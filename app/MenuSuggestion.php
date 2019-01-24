<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuSuggestion extends Model
{
    protected $fillable = [
        'consultation_id',
        'menu_id',
    ];

    public function consultation()
    {
        return $this->belongsTo('App\Consultation');
    }

    public function menu()
    {
        return $this->belongsTo('App\Menu');
    }
}
