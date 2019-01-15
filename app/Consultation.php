<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    protected $fillable = [
        'user_id',
        'weight',
        'bed_time',
        'activity',
        'pregnancy_age'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function menuSuggestion()
    {
        return $this->hasMany('App\MenuSuggestion');
    }

    public static function findAllByUserId($userId)
    {
        return Consultation::where('user_id', $userId)->get();
    }
}
