<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $guard = 'admin';

    public function generateApiToken()
    {
        $this->api_token = str_random('60');
        $this->save();

        return $this->api_token;
    }

    public function menu()
    {
        return $this->hasMany('App\Menu');
    }
}
